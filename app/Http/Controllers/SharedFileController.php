<?php

namespace App\Http\Controllers;

use App\Models\File;
use App\Models\FileShare;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class SharedFileController extends Controller
{
    public function index()
    {
        // Get files shared with the current user directly via belongsToMany
        $sharedFiles = Auth::user()->sharedFiles()->with('user')->latest()->get();
        // Here, $sharedFiles is a collection of File models, not FileShare models.
        return view('shared-files.index', compact('sharedFiles'));
    }

    public function store(Request $request, File $file)
    {
        // Ensure user owns the file
        if ($file->user_id !== Auth::id()) {
            abort(403, 'You do not own this file.');
        }

        $request->validate([
            'email' => 'required|email|exists:users,email',
        ]);

        // Cannot share with yourself
        if ($request->email === Auth::user()->email) {
            return back()->with('error', 'You cannot share a file with yourself.');
        }

        $recipient = User::where('email', $request->email)->firstOrFail();

        // Check if already shared
        if ($file->shares()->where('user_id', $recipient->id)->exists()) {
            return back()->with('error', 'File is already shared with this user.');
        }

        // Create share record
        FileShare::create([
            'file_id' => $file->id,
            'user_id' => $recipient->id,
        ]);

        return back()->with('success', 'File shared successfully with ' . $recipient->name);
    }

    public function destroy(File $file, User $user)
    {
        // Ensure user owns the file
        if ($file->user_id !== Auth::id()) {
            abort(403, 'You do not own this file.');
        }

        $file->shares()->where('user_id', $user->id)->delete();

        return back()->with('success', 'Access revoked for ' . $user->name);
    }

    public function download(File $file)
    {
        // Check if the file is shared with the authenticated user
        $isShared = Auth::user()->sharedFiles()->where('files.id', $file->id)->exists();
        
        if (!$isShared) {
            abort(403, 'You do not have permission to access this file.');
        }

        try {
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

            // Using the global server private key to decrypt the AES key
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
            \Log::error('Shared File Download Error: ' . $e->getMessage());
            return back()->with('error', 'Download/Decryption failed: ' . $e->getMessage());
        }
    }
}
