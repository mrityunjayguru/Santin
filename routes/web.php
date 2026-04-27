<?php

use App\Http\Controllers\ArtController;
use App\Http\Controllers\DownloadArtController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
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

    // art
    Route::get('/art', [ArtController::class, 'index'])->name('art.index');
    Route::get('/art/create', [ArtController::class, 'create'])->name('art.create');
    Route::get('/bulk-upload', [ArtController::class, 'edit'])->name('bulk-upload');
    Route::post('/bulk-upload', [ArtController::class, 'bulkUpload'])->name('bulk-upload.store');
    
    //download-art
    Route::get('/download-art', [DownloadArtController::class, 'index'])->name('download-art.index');

    //users
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
});

require __DIR__.'/auth.php';
