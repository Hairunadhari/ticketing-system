<?php

use App\Http\Controllers\TicketController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('/dashboard', function () {
    return view('pages.dashboard');
});
Route::get('/tickets', function () {
    return view('pages.ticket');
});
Route::get('/tickets/create', function () {
    return view('pages.createticket');
})->name('tickets.create');
Route::get('/login', function () {
    return view('auth.login');
})->name('login');
Route::get('/forgot-password', function () {
    return view('auth.forgot-password');
})->name('password.request');

Route::controller(TicketController::class)->prefix('tickets')->name('tickets.')->group(function(){
    Route::get('/', 'list')->name('list');
    Route::post('/create', 'create')->name('create');
    Route::get('/{id}/detail', 'detail')->name('detail');
    Route::patch('/{id}/status', 'status')->name('status');
    Route::post('/export', 'export')->name('export');
    Route::post('/{id}/set-pending', 'setPending')->name('set-pending');
    Route::post('/{id}/start-work', 'startWork')->name('startWork');
});
