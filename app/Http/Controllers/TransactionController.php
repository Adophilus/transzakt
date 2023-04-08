<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;

class TransactionController extends Controller
{
  public function getTransactions()
  {
    $transactions = Transaction::with('user')->orderBy('created_at', 'desc')->get();
    return response($transactions, 200)->header('Content-Type', 'application/json');
  }

  public function getTransactionById(int $id)
  {
    if ($transaction = Transaction::find($id)) {
      return response($transaction, 200)->header('Content-Type', 'application/json');
    }
    return response('Transaction not found', 404)->header('Content-Type', 'application/json');
  }

  public function updateTransaction(Request $request, int $transaction_id)
  {
    $transaction = Transaction::find($transaction_id);
    $type = $request->input('transactionType');
    $amount = $request->input('amount');

    if ($transaction) {
      if ($transaction->type === "CREDIT") {
        if ($type === "CREDIT") {
          $delta = $transaction->amount - $amount;
          if ($delta >= 0)
            $transaction->user()->decrement('balance', abs($delta));
          else
            $transaction->user()->increment('balance', abs($delta));
        } else {
          $transaction->user()->decrement('balance', $transaction->amount + $amount);
        }
      } else {
        if ($type === "DEBIT") {
          $delta = $transaction->amount - $amount;
          if ($delta >= 0)
            $transaction->user()->increment('balance', abs($delta));
          else
            $transaction->user()->decrement('balance', abs($delta));
        } else {
          $transaction->user()->increment('balance', $transaction->amount + $amount);
        }
      }
      $transaction->update([
        "type" => $type,
        "amount" => $amount
      ]);
      return response("Transaction updated successfully", 204)->header('Content-Type', 'application/json');
    }
    return response('Transaction not found', 404)->header('Content-Type', 'application/json');
  }

  public function deleteTransaction(int $transaction_id)
  {
    $transaction = Transaction::find($transaction_id);
    if ($transaction) {
      if ($transaction->type === 'CREDIT') {
        $transaction->user()->decrement('balance', $transaction->amount);
      } else {
        $transaction->user()->increment('balance', $transaction->amount);
      }
      $transaction->delete();
      return response("Transaction deleted successfully", 204)->header('Content-Type', 'application/json');
    }
    return response("Transaction not found", 404)->header('Content-Type', 'application/json');
  }
}
