<?php

use App\Http\Controllers\PeriodicalController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::post('/periodicals/store', [PeriodicalController::class, 'store'])->name('periodicals.store');

    Route::get('/periodicals/create', [PeriodicalController::class, 'create'])->name('periodicals.create');
});



require __DIR__ . '/auth.php';
