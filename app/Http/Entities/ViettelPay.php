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
        if ($account == null){
            return response()->json([
                'status' => 404,
                'message' => 'Account Not Exist',
            ]);
        } else if (Hash::check($inputPassword,$account->viettelPassword) == false){
            return response()->json([
                'status' => 406,
                'message' => 'Password Incorrect!'
            ]);
        } else return $account;
    }

    public function subtract(Request $request){
        $moneyAmount = $request->input('money');
        
        //errorCode 137: Not enough
        $balance = $this->getBalance($request);
        if ($balance < $moneyAmount){
            return response()->json([
                'status' => 137,
                'message' => 'Balance not enough!'
            ]);
        } else {
            $balance = $balance - $moneyAmount;
            $account = ViettelAcc::where('viettelPhone',$request->input('phone'))->first();
            $account->viettelBalance = $balance;
            $account->update();
            return response()->json([
                'status' => 200,
                'message' => 'Payment executed successfully!'
            ]);
        }
    }

    public function getBalance(Request $request){
        $account = $this->authenticate($request);
        return $account->viettelBalance;
    }
}
?>