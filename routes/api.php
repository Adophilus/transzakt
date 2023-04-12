<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/login', [App\Http\Controllers\AuthController::class, 'login'])->name('api.login');
Route::post('/reset-password', [App\Http\Controllers\AuthController::class, 'resetPassword'])->name('api.reset-password');

Route::get('/users', [App\Http\Controllers\UserController::class, 'getUsers']);
Route::post('/users', [App\Http\Controllers\UserController::class, 'createUser']);
Route::get('/users/search', [App\Http\Controllers\UserController::class, 'searchUser']);
Route::get('/users/{user_id}', [App\Http\Controllers\UserController::class, 'getUserById']);
Route::patch('/users/{user_id}', [App\Http\Controllers\UserController::class, 'updateUser']);
Route::delete('/users/{user_id}', [App\Http\Controllers\UserController::class, 'deleteUser']);
Route::post('/users/{user_id}/transactions', [App\Http\Controllers\UserController::class, 'createTransaction']);
Route::post('/users/{user_id}/block', [App\Http\Controllers\UserController::class, 'blockUser']);
Route::post('/users/{user_id}/unblock', [App\Http\Controllers\UserController::class, 'unblockUser']);

Route::get('/transactions', [App\Http\Controllers\TransactionController::class, 'getTransactions']);
Route::get('/transactions/{transaction_id}', [App\Http\Controllers\TransactionController::class, 'getTransactionById']);
Route::patch('/transactions/{transaction_id}', [App\Http\Controllers\TransactionController::class, 'updateTransaction']);
Route::delete('/transactions/{transaction_id}', [App\Http\Controllers\TransactionController::class, 'deleteTransaction']);

Route::get('/settings', [App\Http\Controllers\SettingsController::class, 'getSettings']);
