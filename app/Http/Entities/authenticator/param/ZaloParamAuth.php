<?php

namespace App\Http\Entities;
use Illuminate\Http\Request;
use App\Models\ZaloAcc;
use Illuminate\Support\Facades\Hash;

class ZaloParamAuth implements IParamAuthenticator{
    public function authenticate(Request $request){
        $inputPhone = $request->input('phone');
        $inputPassword = $request->input('password');

        $account = ZaloAcc::where('zaloPhone',$inputPhone)->first();
        if ($account == null) return -1;
        else if (Hash::check($inputPassword,$account->zaloPassword) == false) return -2;
        else return $account->zaloBalance;
    }

    public function getBalance(Request $request){
        return $this->authenticate($request);
    }
}
?>