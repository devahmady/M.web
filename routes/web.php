<?php

use Illuminate\Support\Facades\Route;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

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
    // Route::get('hotspot/profiledetails/{id}', [\App\Http\Controllers\HotspotController::class, 'showProfile'])->name('profiledetails');
});

Route::prefix("/")->group(function () {
    Route::get('invoice/hotspot', [\App\Http\Controllers\InvoiceController::class, 'index'])->name('invoice.hotspot');
    Route::post('invoice/hotspot', [\App\Http\Controllers\InvoiceController::class, 'print'])->name('print');
});
