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
    Route::get('hotspot/users', [\App\Http\Controllers\HotspotController::class, 'index'])->name('hotspot.users');
    Route::get('hotspot/add', [\App\Http\Controllers\HotspotController::class, 'showAdd'])->name('show.add');
    Route::post('hotspot/add', [\App\Http\Controllers\HotspotController::class, 'add'])->name('hotspot.add');
    Route::get('hotspot/generate', [\App\Http\Controllers\HotspotController::class, 'showGenerate'])->name('show.generate');
    Route::post('hotspot/generate', [\App\Http\Controllers\HotspotController::class, 'generate'])->name('generate');
    Route::get('dell{id}', [\App\Http\Controllers\HotspotController::class, 'dell'])->name('dell');
    Route::get('hotspot/active', [\App\Http\Controllers\HotspotController::class, 'active'])->name('hotspot.active');
    Route::get('hotspot/profile', [\App\Http\Controllers\HotspotController::class, 'profile'])->name('hotspot.profile');
    Route::post('hotspot/profile', [\App\Http\Controllers\HotspotController::class, 'addprofile'])->name('add.profile');
    Route::get('hotspot.traffic', [\App\Http\Controllers\HotspotController::class, 'traffic'])->name('hotspot.traffic');
    Route::get('hotspot/profile/{id}', [\App\Http\Controllers\HotspotController::class, 'delprofile'])->name('delprofile');
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
   
});
Route::prefix("/")->group(function () {
    Route::get('invoice/hotspot', [\App\Http\Controllers\InvoiceController::class, 'index'])->name('invoice.hotspot');
    Route::post('invoice/hotspot', [\App\Http\Controllers\InvoiceController::class, 'print'])->name('print');
});
