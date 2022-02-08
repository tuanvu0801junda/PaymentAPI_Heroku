<?php

namespace App\Http\Entities;
use Illuminate\Http\Request;
use App\Models\ViettelAcc;
use Illuminate\Support\Facades\Hash;

class ViettelParamAuth implements IParamAuthenticator{

    public function authenticate(Request $request){
        $inputPhone = $request->input('phone');
        $inputPassword = $request->input('password');

        $account = ViettelAcc::where('viettelPhone',$inputPhone)->first();
        if ($account == null) return -1;
        else if (Hash::check($inputPassword,$account->viettelPassword) == false) return -2;
        else return $account->viettelBalance;
    }

    public function getBalance(Request $request){
        return $this->authenticate($request);
    }
}
?>
