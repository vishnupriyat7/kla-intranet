<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PeriodicalController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NewsUpdateController;

// Route::get('/', function () {
//     return view('home');
// });


Route::get('/', [HomeController::class, 'index'])->name('home.index');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::post('/periodicals/store', [PeriodicalController::class, 'store'])->name('periodicals.store');

    Route::get('/periodicals/create', [PeriodicalController::class, 'create'])->name('periodicals.create');
    Route::get('/periodicals/show/{id}', [PeriodicalController::class, 'show'])->name('periodicals.show');
    Route::get('/periodicals/edit/{id}', [PeriodicalController::class, 'edit'])->name('periodicals.edit');
    Route::patch('/periodicals/update/{id}', [PeriodicalController::class, 'update'])->name('periodicals.update');

    Route::get('/periodicals', [PeriodicalController::class, 'index'])->name('periodicals.index');

    Route::get('/newsupdates', [NewsUpdateController::class, 'index'])->name('newsupdates.index');
    Route::get('/newsupdates/create', [NewsUpdateController::class, 'create'])->name('newsupdates.create');
    Route::get('/newsupdates/store', [NewsUpdateController::class, 'store'])->name('newsupdates.store');


});



require __DIR__ . '/auth.php';
