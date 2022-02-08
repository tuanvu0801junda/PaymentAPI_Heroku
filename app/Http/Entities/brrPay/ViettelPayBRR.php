<?php

namespace App\Http\Entities;
use Illuminate\Http\Request;
use App\Models\ViettelAcc;
use Illuminate\Support\Facades\Hash;

class ViettelPayBRR implements IBRRPayment{

    public function subtractBRR(Request $request){
        $moneyAmount = $request->money;
        
        // errorCode 137: Not enough | 
        // errorCode 404: Not found  | 
        // errorCode 406: incorrect  | 
        
        $vietAuth = new ViettelBRRAuth();
        $balance = $vietAuth->getBalanceBRR($request);
        if ($balance == -1){
            return response()->json([
                'status' => 404,
                'message' => 'ViettelPay Account Not Exist',
            ]);
        } else if ($balance == -2){
            return response()->json([
                'status' => 406,
                'message' => 'ViettelPay Password Incorrect!'
            ]);
        } else if ($balance < $moneyAmount){
            return response()->json([
                'status' => 137,
                'message' => 'ViettelPay Balance not enough!'
            ]);
        } else {
            $balance = $balance - $moneyAmount;
            $account = ViettelAcc::where('viettelPhone',$request->phone)->first();
            $account->viettelBalance = $balance;
            $account->update();
            return response()->json([
                'status' => 200,
                'message' => 'Payment by ViettelPay executed successfully!'
            ]);
        }
    }

}
?>
