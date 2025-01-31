<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\AttendanceController;

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

Route::get('/', [AuthController::class, 'index'])->name('login');
// web.php
//Route::post('/login', 'Auth\LoginController@login')->name('auth.login');
//Route::put('/password/reset', 'Auth\ResetPasswordController@reset')->name('password.reset');

Route::group(['middleware' => ['web']], function () {
    Route::get('/chat', [ChatController::class, 'index'])
        ->name('chat');
    Route::get('/dashboard', [HomeController::class, 'index'])
        ->name('dashboard');
    Route::get('/attendance', [AttendanceController::class, 'index'])
        ->name('attendance');
    });

Route::group(['middleware' => ['guest']], function () {
    // Once signed into to their accounts users sign the attendance for the specified class.
    Route::get('/signattendance/{id}', [AttendanceController::class, 'attendance'])
        ->name('sign.attendance');
});