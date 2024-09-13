<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TrustSealVerificationController;
use App\Http\Controllers\AdminController;

Route::get('/', function () {
    return view('home-landing');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::middleware(['auth'])->group(function () {
    Route::get('admin/trust-seals', [AdminController::class, 'index'])->name('admin.trust_seals.index');
    Route::post('admin/trust-seals', [AdminController::class, 'store'])->name('admin.trustseals.store');
});


Route::get('verify', function () {
    return view('verify');
});
Route::post('verify', [TrustSealVerificationController::class, 'verify'])->name('verify.submit');
