<?php

namespace App\Http\Entities\paramPay;
use Illuminate\Http\Request;
use App\Models\BankAcc;
use Illuminate\Support\Facades\Hash;
use App\Http\Entities\IParamPayment;
use App\Http\Entities\BankParamAuth;


class BankPay implements IParamPayment{

    public function subtract(Request $request){
        $moneyAmount = $request->input('money');
        
        // errorCode 137: Not enough | 
        // errorCode 404: Not found  | 
        // errorCode 4061: Bank Cvv Code Incorrect  | 
        // errorCode 4062: Name of Card Owner Incorrect  | 
        // errorCode 4063: Bank ExpiredDate Incorrect  | 

        $bankAuth = new BankParamAuth();
        $balance = $bankAuth->getBalance($request);
        if($balance == -1){
            return response()->json([
                'status' => 404,
                'message' => 'Bank CardId Not Exist!'
            ]);
        } else if ($balance == -2){
            return response()->json([
                'status' => 4061, 
                'message' => 'Bank Cvv Code Incorrect!',
            ]);
        } else if ($balance == -3){
            return response()->json([
                'status' => 4062,
                'message' => 'Name of Bank Card Owner Incorrect!',
            ]);
        } else if ($balance == -4){
            return response()->json([
                'status' => 4063,
                'message' => 'Bank ExpiredDate Incorrect!'
            ]);            
        } else if ($balance < $moneyAmount){
            return response()->json([
                'status' => 137,
                'message' => 'Bank Balance not enough!'
            ]);
        } else {
            $balance = $balance - $moneyAmount;
            $account = BankAcc::where('bankCard',$request->input('card'))->first();
            $account->bankBalance = $balance;
            $account->update();
            return response()->json([
                'status' => 200,
                'message' => 'Payment via BankPay executed successfully!'
            ]);
        }
    }

}
?>