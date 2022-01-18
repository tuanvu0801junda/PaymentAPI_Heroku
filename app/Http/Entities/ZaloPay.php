<?php

namespace App\Http\Entities;
use Illuminate\Http\Request;
use App\Models\ZaloAcc;
use Illuminate\Support\Facades\Hash;

class ZaloPay implements IPayment{
    public function authenticate(Request $request){
        $inputPhone = $request->input('phone');
        $inputPassword = $request->input('password');

        $account = ZaloAcc::where('zaloPhone',$inputPhone)->first();
        if ($account == null) return -1;
        else if (Hash::check($inputPassword,$account->zaloPassword) == false) return -2;
        else return $account->zaloBalance;
    }

    public function subtract(Request $request){
        $moneyAmount = $request->input('money');
        
        // errorCode 137: Not enough | 
        // errorCode 404: Not found  | 
        // errorCode 406: incorrect  | 
        
        $balance = $this->getBalance($request);
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
    
    public function getBalance(Request $request){
        return $this->authenticate($request);
    }

    // ************** NEW FUNCTION FOR BODY RAW REQUEST (BRR) **************

    public function authenticateBRR(Request $request){
        $inputPhone = $request->phone;
        $inputPassword = $request->password;

        $account = ZaloAcc::where('zaloPhone',$inputPhone)->first();
        if ($account == null) return -1;
        else if (Hash::check($inputPassword,$account->zaloPassword) == false) return -2;
        else return $account->zaloBalance;
    }

    public function subtractBRR(Request $request){
        $moneyAmount = $request->money;
        
        // errorCode 137: Not enough | 
        // errorCode 404: Not found  | 
        // errorCode 406: incorrect  | 
        
        $balance = $this->getBalance($request);
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
            $account = ZaloAcc::where('zaloPhone',$request->phone)->first();
            $account->zaloBalance = $balance;
            $account->update();
            return response()->json([
                'status' => 200,
                'message' => 'Payment by ZaloPay executed successfully!'
            ]);
        }
    }
    
    public function getBalanceBRR(Request $request){
        return $this->authenticateBRR($request);
    }
}
?>