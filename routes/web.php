<?php

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

// Route::get('/', function () {
//     return redirect('/dashboard');
// });

Route::get('/login', function () {
    return view('login');
})->name('login');

Route::get('/account/reset-password', function () {
    return view('reser-password');
})->name('reset-password');

Route::get('{path}', function () {
    return view('index');
})->where('path', '(dashboard|users|settings|transactions)')->name('dashboard');
