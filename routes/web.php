<?php

use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\TicketController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/login');
});

// ─── Guest only (sudah login → redirect ke dashboard) ───────────────────────
Route::middleware('guest')->group(function () {

    Route::get('/forgot_password', function () {
        return view('auth.forgot_password');
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

    Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

    Route::controller(TicketController::class)->prefix('tickets')->name('tickets.')->group(function () {
        Route::get('/', 'list')->name('list');
        Route::post('/create', 'create')->name('create');
        Route::put('/{id}/update', 'update')->name('update');
        Route::patch('/{id}/status', 'status')->name('status');
        Route::post('/export', 'export')->name('export');
        Route::post('/{id}/set-pending', 'setPending')->name('set-pending');
        Route::post('/{id}/start-work', 'startWork')->name('startWork');
        Route::post('/{id}/delete', 'delete')->name('delete');
        Route::post('/{id}/finish-work', 'finishWork')->name('finishWork');
        Route::post('/{id}/close', 'close')->name('close');
    });

});
