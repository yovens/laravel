<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Transaction;

class TransactionController extends Controller
{
    public function index() {
        $transactions = Transaction::with('user','vehicle')->get();
        return view('admin.transactions.index', compact('transactions'));
    }

    public function destroy(Transaction $transaction){
        $transaction->delete();
        return back()->with('success','Transaction supprimée');
    }
}
