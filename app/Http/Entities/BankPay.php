<?php

namespace App\Http\Entities;
use Illuminate\Http\Request;
use App\Models\BankAcc;
use Illuminate\Support\Facades\Hash;

class BankPay implements IPayment{
    public function authenticate(Request $request){
        $inputCard = $request->input('card');
        $inputName = $request->input('name');
        $inputCvv = $request->input('cvv');
        $inputExpired = $request->input('expired');

        $account = BankAcc::where('bankCard',$inputCard)->first();
        //errorCode 404: NOT FOUND | errorCode 406: NOT ACCEPTABLE

        if ($account == null) {
            return response()->json([
                'status' => 404,
                'message' => 'Bank CardId Not Exist!'
            ]);
        } else if (Hash::check($inputCvv, $account->bankCvv) == false) {
            return response()->json([
                'status' => 406, 
                'message' => 'Cvv Code Incorrect!',
            ]);
        } else if (strcmp($inputName,$account->bankName) != 0){
            return response()->json([
                'status' => 406,
                'message' => 'Name of Card Owner Incorrect!',
            ]);
        } else if (strcmp($inputExpired,$account->bankExpired) != 0){
            return response()->json([
                'status' => 406,
                'message' => 'ExpiredDate Incorrect!'
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
            $account = BankAcc::where('bankCard',$request->input('card'))->first();
            $account->bankBalance = $balance;
            $account->update();
            return response()->json([
                'status' => 200,
                'message' => 'Payment executed successfully!'
            ]);
        }
    }

    public function getBalance(Request $request){
        $account = $this->authenticate($request);
        return $account->bankBalance;
    }
}
?>