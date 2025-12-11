<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function show(){
        if(!auth()->check()){
            return view('welcome');
        }

        $transactions = auth()->user()->transactions()->latest()->get();

        $totalIncome = $transactions->where('type', 'income')->sum('amount');
        $totalExpense = $transactions->where('type', 'expense')->sum('amount');
        $balance = $totalIncome - $totalExpense;

        return view('dashboard', [
            'transactions' => $transactions,
            'totalIncome' => $totalIncome,
            'totalExpense' => $totalExpense,
            'balance' => $balance
        ]);
    }

    
    public function addTransaction(Request $request){
        $data = $request->validate([
            'name' => 'required',
            'amount' => 'required|integer',
            'type' => 'required'
        ]);

        auth()->user()->transactions()->create($data);

        return redirect('/dashboard');
    }
}
