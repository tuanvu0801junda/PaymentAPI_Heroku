<?php

namespace App\Http\Entities;
use Illuminate\Http\Request;
use App\Models\BankAcc;
use Illuminate\Support\Facades\Hash;

class BankParamAuth implements IParamAuthenticator{
    public function authenticate(Request $request){
        $inputCard = $request->input('card');
        $inputName = $request->input('name');
        $inputCvv = $request->input('cvv');
        $inputExpired = $request->input('expired');

        $account = BankAcc::where('bankCard',$inputCard)->first();

        if ($account == null) return -1;
        else if (Hash::check($inputCvv, $account->bankCvv) == false) return -2;
        else if (strcmp($inputName,$account->bankName) != 0) return -3;
        else if (strcmp($inputExpired,$account->bankExpired) != 0) return -4;
        else return $account->bankBalance;
    }

    public function getBalance(Request $request){
        return $this->authenticate($request);
    }
}
?>