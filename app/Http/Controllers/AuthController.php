<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AuthController extends Controller
{
  public function login(Request $request)
  {
    $credentials = $request->validate([
      'email' => ['required', 'email'],
      'password' => ['required'],
    ]);
    $user = User::where('email', '=', $credentials["email"])->first();
    if (!$user) {
      return redirect()->route('login')->with('error', 'Invalid email or password!');
    }
    // return redirect()->route('login', ['error' => 'Invalid email or password!']);
    return redirect()->route('login')->with('loginError', 'Invalid email or password!');
    Auth::login($user);

    return redirect()->intended('dashboard');
  }
}
