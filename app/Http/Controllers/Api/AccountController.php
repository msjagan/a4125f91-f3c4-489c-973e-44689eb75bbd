<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\Payment;
use Illuminate\Support\Facades\Validator;

class AccountController extends Controller
{
    public function store(Request $request)
    {
        #write your code for account creation here...
        #model name = Account
        #table name = accounts
        #table fields = id,balance
        #all fields are required

        $balance = 0;
        if($request->only('balance')) {
            $balance = $request->input('balance');
        }

        $account = Account::create(['balance' => $balance]);

        return response()->json($account, 201);
    }

    public function get($id)
    {
        #write your code to get account details...
        #model name = Account
        #table name = accounts
        #table fields = id,balance

        $account = Account::find($id);

        if (!$account) {
            return response()->json(['error' => 'Account not found'], 404);
        }

        // Calculate the total balance for the account
        $totalBalance = $account->payments()->sum('amount');
        $account->balance = $totalBalance;

        return response()->json($account, 200);
    }
}