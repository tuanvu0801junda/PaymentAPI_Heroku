<?php
namespace App\Http\Authenticators;
use App\Models\ViettelAcc;
use Illuminate\Support\Facades\Hash;

class ViettelAuth implements IAuth{

    public static function authenticate($array){
        $inputPhone = $array['phone']; 
        $inputPassword = $array['password']; 

        $account = ViettelAcc::where('viettelPhone',$inputPhone)->first();
        if ($account == null) return -1;
        else if (Hash::check($inputPassword,$account->viettelPassword) == false) return -2;
        else return $account->viettelBalance;
    }
}

?>