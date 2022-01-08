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
        if ($account == null){
            return response()->json([
                'status' => 404,
                'message' => 'Account Not Exist',
            ]);
        } else if (Hash::check($inputPassword,$account->zaloPassword) == false){
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
            $account = ZaloAcc::where('zaloPhone',$request->input('phone'))->first();
            $account->zaloBalance = $balance;
            $account->update();
            return response()->json([
                'status' => 200,
                'message' => 'Payment executed successfully!'
            ]);
        }
    }
    
    public function getBalance(Request $request){
        $account = $this->authenticate($request);
        return $account->zaloBalance;
    }
}
?>