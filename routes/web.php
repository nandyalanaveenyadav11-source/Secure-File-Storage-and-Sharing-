<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Secure File Storage routes
    Route::name('files.')->prefix('files')->group(function () {
        Route::get('/', [FileController::class, 'index'])->name('index');
        Route::post('/', [FileController::class, 'upload'])->name('upload');
        Route::get('{file}/download', [FileController::class, 'download'])->name('download');
        Route::get('{file}/raw', [FileController::class, 'raw'])->name('raw');
        Route::delete('{file}', [FileController::class, 'destroy'])->name('destroy');
        
        // Sharing routes
        Route::post('{file}/share', [\App\Http\Controllers\SharedFileController::class, 'store'])->name('share');
        Route::delete('{file}/share/{user}', [\App\Http\Controllers\SharedFileController::class, 'destroy'])->name('share.destroy');
    });

    // Shared Files Dashboard
    Route::name('shared-files.')->prefix('shared-files')->group(function () {
        Route::get('/', [\App\Http\Controllers\SharedFileController::class, 'index'])->name('index');
        Route::get('{file}/download', [\App\Http\Controllers\SharedFileController::class, 'download'])->name('download');
    });
});

require __DIR__.'/auth.php';
