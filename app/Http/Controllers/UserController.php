<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Transaction;

class UserController extends Controller
{
  public function index()
  {
    return response(User::all(), 200)->header('Content-Type', 'application/json');
  }

  public function create(Request $request)
  {
    $first_name = $request->input("firstName");
    $last_name = $request->input("lastName");
    $email = $request->input("email");
    $balance = $request->input("balance");
    $account_number = $request->input("accountNumber");

    User::create([
      "first_name" => $first_name,
      "last_name" => $last_name,
      "email" => $email,
      "balance" => $balance,
      "account_number" => $account_number,
    ]);

    return response([
      "message" => "User created successfully",
    ], 201)->header('Content-Type', 'application/json');
  }

  public function createTransaction(Request $request, int $user_id)
  {
    $type = $request->input('type');
    $amount = $request->input('amount');

    Transaction::create([
      "user_id" => $user_id,
      "type" => $type,
      "amount" => $amount
    ]);

    if ($type === "CREDIT") {
      User::find($user_id)->increment('balance', $amount);
    } else {
      User::find($user_id)->decrement('balance', $amount);
    }

    return response([
      "message" => "Transaction created successfully",
    ], 201)->header('Content-Type', 'application/json');
  }

  public function block(Request $request, int $user_id)
  {
    User::find($user_id)->update([
      "blocked" => true
    ]);

    return response([
      "message" => "User blocked successfully!",
    ], 204)->header('Content-Type', 'application/json');
  }

  public function unblock(Request $request, int $user_id)
  {
    User::find($user_id)->update([
      "blocked" => false
    ]);

    return response([
      "message" => "User unblocked successfully!",
    ], 204)->header('Content-Type', 'application/json');
  }
}
