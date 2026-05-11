<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\TicketController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/login');
});

// ─── Guest only (sudah login → redirect ke dashboard) ───────────────────────
Route::middleware('guest')->group(function () {

    Route::get('/forgot-password', function () {
        return view('auth.forgot-password');
    })->name('password.request');

    Route::controller(RegisterController::class)->prefix('register')->name('register.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::post('/create', 'create')->name('create');
    });

    Route::controller(LoginController::class)->prefix('login')->name('login.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::post('/create', 'login')->name('create');
    });

});

// ─── Auth only (belum login → redirect ke login) ─────────────────────────────
Route::middleware('auth')->group(function () {

    Route::get('/dashboard', function () {
        return view('pages.dashboard');
    });

    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

    Route::controller(TicketController::class)->prefix('tickets')->name('tickets.')->group(function () {
        Route::get('/', 'list')->name('list');
        Route::post('/create', 'create')->name('create');
        Route::get('/{id}/detail', 'detail')->name('detail');
        Route::patch('/{id}/status', 'status')->name('status');
        Route::post('/export', 'export')->name('export');
        Route::post('/{id}/set-pending', 'setPending')->name('set-pending');
        Route::post('/{id}/start-work', 'startWork')->name('startWork');
    });

});