<?php

namespace App\Http\Controllers;

use App\Models\File;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class FileController extends Controller
{
    public function index()
    {
        $files = Auth::user()->files()->latest()->get();
        return view('files.index', compact('files'));
    }

    public function upload(Request $request)
    {
        try {
            $request->validate([
                'file' => 'required|file|max:10240|mimes:pdf,docx,txt,jpg,png,zip', // 10MB
            ]);

            $file = $request->file('file');
            $originalName = $file->getClientOriginalName();
            $fileSize = $file->getSize();
            $content = $file->get();

            // Ensure directories exist via Storage
            if (!Storage::exists('keys')) Storage::makeDirectory('keys');
            if (!Storage::exists('encrypted_files')) Storage::makeDirectory('encrypted_files');

            // Generate AES key and IV
            $aesKey = random_bytes(32); // AES-256
            $iv = random_bytes(16); // CBC IV

            // Encrypt file with AES-256-CBC
            $encrypted = openssl_encrypt($content, 'aes-256-cbc', $aesKey, 0, $iv);
            if ($encrypted === false) {
                throw new \Exception('AES Encryption failed: ' . openssl_error_string());
            }

            // Generate or get server RSA keys
            $privateKeyPath = 'keys/server_private.pem';
            $publicKeyPath = 'keys/server_public.pem';
            
            $privKey = '';
            $pubKey = '';

            if (!Storage::exists($privateKeyPath) || !Storage::exists($publicKeyPath)) {
                $config = [
                    "digest_alg" => "sha256",
                    "private_key_bits" => 2048,
                    "private_key_type" => OPENSSL_KEYTYPE_RSA,
                    "config" => 'C:/xampp/php/extras/ssl/openssl.cnf',
                ];
                
                $res = openssl_pkey_new($config);
                
                if (!$res) {
                    $config['config'] = 'C:/xampp/apache/conf/openssl.cnf';
                    $res = openssl_pkey_new($config);
                }

                if (!$res) {
                    throw new \Exception('RSA Key Generation failed. OpenSSL config not found.');
                }

                if (!openssl_pkey_export($res, $privKey, null, $config)) {
                    throw new \Exception('RSA Private Key Export failed: ' . openssl_error_string());
                }

                $pubKeyData = openssl_pkey_get_details($res);
                $pubKey = $pubKeyData['key'];

                Storage::put($privateKeyPath, $privKey);
                Storage::put($publicKeyPath, $pubKey);
            } else {
                $privKey = Storage::get($privateKeyPath);
                $pubKey = Storage::get($publicKeyPath);
            }

            // Encrypt AES key with RSA public
            $encryptedAesKey = '';
            if (!openssl_public_encrypt($aesKey, $encryptedAesKey, $pubKey, OPENSSL_PKCS1_OAEP_PADDING)) {
                throw new \Exception('RSA Encryption of AES key failed: ' . openssl_error_string());
            }

            // Store encrypted file and data
            $encryptedPath = 'encrypted_files/' . uniqid() . '.' . $file->getClientOriginalExtension();
            Storage::put($encryptedPath, $encrypted . '::' . base64_encode($iv));

            File::create([
                'user_id' => Auth::id(),
                'file_name' => $originalName,
                'file_path' => $encryptedPath,
                'encrypted_key' => base64_encode($encryptedAesKey),
                'file_size' => $fileSize,
            ]);

            if ($request->expectsJson()) {
                return response()->json(['success' => 'File uploaded and encrypted successfully']);
            }

            return back()->with('success', 'File uploaded and encrypted successfully');

        } catch (\Exception $e) {
            \Log::error('Upload Error: ' . $e->getMessage());
            if ($request->expectsJson()) {
                return response()->json(['error' => $e->getMessage()], 500);
            }
            return back()->with('error', $e->getMessage());
        }
    }

    public function raw(File $file)
    {
        try {
            if ($file->user_id !== Auth::id()) {
                abort(403);
            }

            if (!Storage::exists($file->file_path)) {
                return response()->json(['error' => 'File not found'], 404);
            }

            $encryptedContent = Storage::get($file->file_path);
            if (!str_contains($encryptedContent, '::')) {
                return response()->json(['error' => 'Invalid file format'], 500);
            }

            [$encryptedData, $ivB64] = explode('::', $encryptedContent, 2);

            return response()->json([
                'file_name' => $file->file_name,
                'encrypted_data_preview' => substr($encryptedData, 0, 500) . (strlen($encryptedData) > 500 ? '...' : ''),
                'full_encrypted_data' => $encryptedData,
                'iv' => $ivB64,
                'algorithm' => 'AES-256-CBC',
                'key_protection' => 'RSA-2048 (OAEP Padding)'
            ]);

        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function download(File $file)
    {
        try {
            if ($file->user_id !== Auth::id()) {
                abort(403);
            }

            if (!Storage::exists($file->file_path)) {
                throw new \Exception('Encrypted file not found in storage.');
            }

            $encryptedContent = Storage::get($file->file_path);
            if (!str_contains($encryptedContent, '::')) {
                throw new \Exception('Invalid encrypted file format.');
            }

            [$encryptedData, $ivB64] = explode('::', $encryptedContent, 2);
            $iv = base64_decode($ivB64);

            $privateKeyPath = 'keys/server_private.pem';
            if (!Storage::exists($privateKeyPath)) {
                throw new \Exception('RSA Private key missing. Cannot decrypt.');
            }

            $privKey = Storage::get($privateKeyPath);
            $aesKey = '';
            if (!openssl_private_decrypt(base64_decode($file->encrypted_key), $aesKey, $privKey, OPENSSL_PKCS1_OAEP_PADDING)) {
                throw new \Exception('RSA Decryption of AES key failed: ' . openssl_error_string());
            }

            $decrypted = openssl_decrypt($encryptedData, 'aes-256-cbc', $aesKey, 0, $iv);
            if ($decrypted === false) {
                throw new \Exception('AES Decryption failed: ' . openssl_error_string());
            }

            return response($decrypted)
                ->header('Content-Type', 'application/octet-stream')
                ->header('Content-Disposition', 'attachment; filename="' . $file->file_name . '"');

        } catch (\Exception $e) {
            \Log::error('Download Error: ' . $e->getMessage());
            return back()->with('error', 'Download/Decryption failed: ' . $e->getMessage());
        }
    }

    public function destroy(File $file)
    {
        if ($file->user_id !== Auth::id()) {
            abort(403);
        }

        Storage::delete($file->file_path);
        $file->delete();

        return back()->with('success', 'File deleted');
    }
}

