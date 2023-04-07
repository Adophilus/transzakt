<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

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
    $account_number = $request->input("accountNumber");

    User::create([
      "first_name" => $first_name,
      "last_name" => $last_name,
      "email" => $email,
      "account_number" => $account_number,
    ]);

    return response([
      "message" => "User created successfully",
    ], 201)->header('Content-Type', 'application/json');
  }
}
