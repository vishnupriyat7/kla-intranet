<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PeriodicalController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NewsUpdateController;
use App\Http\Controllers\PeriodicalMasterController;

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

    Route::get('/news-updates', [NewsUpdateController::class, 'index'])->name('news-updates.index');
    Route::get('/news-updates/create', [NewsUpdateController::class, 'create'])->name('news-updates.create');
    Route::post('/news-updates/store', [NewsUpdateController::class, 'store'])->name('news-updates.store');
    Route::get('/news-updates/edit/{id}', [NewsUpdateController::class, 'edit'])->name('news-updates.edit');
    Route::patch('/news-updates/update/{id}', [NewsUpdateController::class, 'update'])->name('news-updates.update');
    Route::delete('/news-updates/destroy/{id}', [NewsUpdateController::class, 'destroy'])->name('news-updates.destroy');




    Route::get('/periodical-masters', [PeriodicalMasterController::class, 'index'])->name('periodical-masters.index');
    Route::get('/periodical-masters/create', [PeriodicalMasterController::class, 'create'])->name('periodical-masters.create');

    Route::post('/periodical-masters/store', [PeriodicalMasterController::class, 'store'])->name('periodical-masters.store');
    Route::get('/periodical-masters/edit/{id}', [PeriodicalMasterController::class, 'edit'])->name('periodical-masters.edit');
    Route::patch('/periodical-masters/update/{id}', [PeriodicalMasterController::class, 'update'])->name('periodical-masters.update');
    Route::delete('/periodical-masters/destroy/{id}', [PeriodicalMasterController::class, 'destroy'])->name('periodical-masters.destroy');
});



require __DIR__ . '/auth.php';
