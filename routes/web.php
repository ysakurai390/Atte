<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AtteController;

Route::get('/', [AtteController::class, 'index']);
Route::post('/stamp/clockin', [AtteController::class, 'clockin']);
Route::post('/stamp/clockout', [AtteController::class, 'clockout']);
Route::post('/stamp/reststart', [AtteController::class, 'reststart']);
Route::post('/stamp/restend', [AtteController::class, 'restend']);
Route::get('/attendance', [AtteController::class, 'search']);




Route::get('/welcome', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
