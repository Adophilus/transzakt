<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;

class TransactionController extends Controller
{
  public function index()
  {
    return response(Transaction::all(), 200)->header('Content-Type', 'application/json');
  }
}
