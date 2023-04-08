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


Route::get('/users', [App\Http\Controllers\UserController::class, 'getUsers']);
Route::get('/users/{user_id}', [App\Http\Controllers\UserController::class, 'getUserById']);
Route::post('/users', [App\Http\Controllers\UserController::class, 'createUser']);
Route::patch('/users/{user_id}', [App\Http\Controllers\UserController::class, 'updateUser']);
Route::post('/users/{user_id}/transactions', [App\Http\Controllers\UserController::class, 'createTransaction']);
Route::post('/users/{user_id}/block', [App\Http\Controllers\UserController::class, 'blockUser']);
Route::post('/users/{user_id}/unblock', [App\Http\Controllers\UserController::class, 'unblockUser']);

Route::get('/transactions', [App\Http\Controllers\TransactionController::class, 'getTransactions']);
Route::get('/transactions/{transaction_id}', [App\Http\Controllers\TransactionController::class, 'getTransactionById']);
Route::patch('/transactions/{transaction_id}', [App\Http\Controllers\TransactionController::class, 'updateTransaction']);
Route::delete('/transactions/{transaction_id}', [App\Http\Controllers\TransactionController::class, 'deleteTransction']);
