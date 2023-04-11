<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Transaction;
use App\Mail\ResetPassword;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
  public function getUsers()
  {
    $users = User::orderBy('first_name', 'ASC')->cursorPaginate();
    return response($users, 200)->header('Content-Type', 'application/json');
  }

  public function getUserById(string $user_id)
  {
    if ($user = User::find($user_id)) {
      return response($user, 200)->header('Content-Type', 'application/json');
    } else {
      return response('User not found', 404)->header('Content-Type', 'application/json');
    }
  }

  public function createUser(Request $request)
  {
    $first_name = $request->input("firstName");
    $last_name = $request->input("lastName");
    $email = $request->input("email");
    $balance = $request->input("balance");
    $account_number = $request->input("accountNumber");

    $user = User::create([
      "first_name" => $first_name,
      "last_name" => $last_name,
      "email" => $email,
      "balance" => $balance,
      "account_number" => $account_number,
      "otp" => rand(100000, 999999)
    ]);

    Mail::to($user->email)->send(new ResetPassword($user));

    return response([
      "message" => "User created successfully",
    ], 201)->header('Content-Type', 'application/json');
  }

  public function updateUser(Request $request, string $user_id)
  {
    $first_name = $request->input("firstName");
    $last_name = $request->input("lastName");
    $email = $request->input("email");
    $balance = $request->input("balance");
    $account_number = $request->input("accountNumber");

    $user = User::find($user_id);

    if ($first_name)
      $user->first_name = $first_name;
    if ($last_name)
      $user->last_name = $last_name;
    if ($email)
      $user->email = $email;
    if ($balance)
      $user->balance = $balance;
    if ($account_number)
      $user->account_number = $account_number;
    $user->save();

    return response([
      "message" => "User updated successfully",
    ], 200)->header('Content-Type', 'application/json');
  }

  public function deleteUser(string $user_id)
  {
    $user = User::find($user_id);
    if ($user) {
      Transaction::where('user_id', $user_id)->delete();
      $user->delete();
      return response([
        "message" => "User deleted successfully",
      ], 200)->header('Content-Type', 'application/json');
    } else {
      return response([
        "message" => "User not found",
      ], 404)->header('Content-Type', 'application/json');
    }
  }

  public function createTransaction(Request $request, string $user_id)
  {
    $type = $request->input('type');
    $status = $request->input('status');
    $amount = $request->input('amount');

    Transaction::create([
      "user_id" => $user_id,
      "type" => $type,
      "amount" => $amount,
      "status" => $status
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

  public function blockUser(string $user_id)
  {
    User::find($user_id)->update([
      "blocked" => true
    ]);

    return response([
      "message" => "User blocked successfully!",
    ], 204)->header('Content-Type', 'application/json');
  }

  public function unblockUser(string $user_id)
  {
    User::find($user_id)->update([
      "blocked" => false
    ]);

    return response([
      "message" => "User unblocked successfully!",
    ], 204)->header('Content-Type', 'application/json');
  }
}
