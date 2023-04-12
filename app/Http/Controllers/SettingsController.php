<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class SettingsController extends Controller
{
  public function getSettings()
  {
    $user = Auth::user();

    return response([
      "email" => $user->email,
    ], 200)->header('Content-Type', 'application/json');
  }
}
