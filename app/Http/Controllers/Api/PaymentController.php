<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\Payment;
use App\Models\Account;
use App\Http\Controllers\Controller;
use Validator;

class PaymentController extends Controller
{
  public function store(Request $request)
  {
        #write your code for payment creation here...
        #model name = Payment
        #table name = payments
        #table fields = id,account,amount
        #all fields are required

        // $validator = Validator::make($request->all(), [
        //   'account' => 'required|exists:accounts,id',
        //   'amount' => 'required|numeric|min:0',
        // ]);

        // if ($validator->fails()) {
        //     return response()->json(['error' => $validator->errors()], 400);
        // }

        // $payment = Payment::create($request->all());

        // return response()->json($payment, 201);

        $validator = Validator::make($request->all(), [
          'account' => 'required',
          'amount' => 'required|numeric|min:0',
        ]);

        if ($validator->fails()) {
            return response()->json(['errMsg' => 'MandatoryFieldsNotComplete'], 400);
        }

        $accountId = $request->input('account');
        $account = Account::find($accountId);
        if(!$account) {
            return response()->json(['error' => 'Account not found'], 404);
        }

        $payment = Payment::create([
            'account' => $request->input('account'),
            'amount' => $request->input('amount')
        ]);

        return response()->json($payment, 201);
  
  }
}
