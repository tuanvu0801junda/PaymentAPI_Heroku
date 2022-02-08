<?php

namespace App\Http\Entities;
use Illuminate\Http\Request;
use App\Models\ZaloAcc;
use Illuminate\Support\Facades\Hash;

class ZaloPay implements IParamPayment{

    public function subtract(Request $request){
        $moneyAmount = $request->input('money');
        
        // errorCode 137: Not enough | 
        // errorCode 404: Not found  | 
        // errorCode 406: incorrect  | 
        
        $zaloAuth = new ZaloParamAuth();
        $balance = $zaloAuth->getBalance($request);
        if($balance == -1){
            return response()->json([
                'status' => 404,
                'message' => 'ZaloPay Account Not Exist',
            ]);
        } else if ($balance == -2){
            return response()->json([
                'status' => 406,
                'message' => 'ZaloPay Password Incorrect!'
            ]);
        } else if ($balance < $moneyAmount){
            return response()->json([
                'status' => 137,
                'message' => 'ZaloPay Balance not enough!'
            ]);
        } else {
            $balance = $balance - $moneyAmount;
            $account = ZaloAcc::where('zaloPhone',$request->input('phone'))->first();
            $account->zaloBalance = $balance;
            $account->update();
            return response()->json([
                'status' => 200,
                'message' => 'Payment by ZaloPay executed successfully!'
            ]);
        }
    }
}
?>