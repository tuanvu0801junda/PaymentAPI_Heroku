<?php

namespace App\Http\Entities;
use Illuminate\Http\Request;
use App\Models\ViettelAcc;
use Illuminate\Support\Facades\Hash;

class ViettelPay implements IPayment{
    public function authenticate(Request $request){
        $inputPhone = $request->input('phone');
        $inputPassword = $request->input('password');

        $account = ViettelAcc::where('viettelPhone',$inputPhone)->first();
        if ($account == null) return -1;
        else if (Hash::check($inputPassword,$account->viettelPassword) == false) return -2;
        else return $account->viettelBalance;
    }

    public function subtract(Request $request){
        $moneyAmount = $request->input('money');
        
        // errorCode 137: Not enough | 
        // errorCode 404: Not found  | 
        // errorCode 406: incorrect  | 
        
        $balance = $this->getBalance($request);
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
            $account = ViettelAcc::where('viettelPhone',$request->input('phone'))->first();
            $account->viettelBalance = $balance;
            $account->update();
            return response()->json([
                'status' => 200,
                'message' => 'Payment by ViettelPay executed successfully!'
            ]);
        }
    }

    public function getBalance(Request $request){
        return $this->authenticate($request);
    }
}
?>