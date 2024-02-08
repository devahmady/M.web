<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('login.login');
});
Route::prefix("/")->group(function () {
    Route::post('/login', [\App\Http\Controllers\LoginController::class, 'login'])->name('login.mikman');
    Route::get('/login', [\App\Http\Controllers\LoginController::class, 'logout'])->name('login.login');
});
Route::prefix("/")->group(function () {
    Route::get('dashboard', [\App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');
    Route::get('graf/{interfaceName}', [\App\Http\Controllers\DashboardController::class, 'graf'])->name('graf');
    Route::get('income', [\App\Http\Controllers\DashboardController::class, 'income'])->name('income');
});

Route::prefix("/")->group(function () {
    Route::get('pppoe/addserver', [\App\Http\Controllers\PPPoEController::class, 'show'])->name('pppoe.server');
    Route::post('pppoe/addserver', [\App\Http\Controllers\PPPoEController::class, 'addserver'])->name('add.server');
    Route::get('pppoe/dellserver/{id}', [\App\Http\Controllers\PPPoEController::class, 'delserver'])->name('delserver');
    Route::get('pppoe/profile', [\App\Http\Controllers\PPPoEController::class, 'profile'])->name('pppoe.profile');
    Route::post('pppoe/profile', [\App\Http\Controllers\PPPoEController::class, 'addprofile'])->name('add.profile.pppoe');
    Route::get('pppoe/dellprofile/{id}', [\App\Http\Controllers\PPPoEController::class, 'dellprofile'])->name('dellprofile');
    Route::get('pppoe/secret', [\App\Http\Controllers\PPPoEController::class, 'secret'])->name('secret.pppoe');
    Route::post('pppoe/secret', [\App\Http\Controllers\PPPoEController::class, 'addsecret'])->name('add.secret');
    Route::get('pppoe/dellsecret/{id}', [\App\Http\Controllers\PPPoEController::class, 'dellsecret'])->name('dellsecret');
    Route::get('pppoe/active', [\App\Http\Controllers\PPPoEController::class, 'active'])->name('active.pppoe');
    Route::get('pppoe/dellactive/{id}', [\App\Http\Controllers\PPPoEController::class, 'dellactive'])->name('dellactive');
});

