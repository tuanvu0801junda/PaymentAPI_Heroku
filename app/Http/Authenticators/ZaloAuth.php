<?php
namespace App\Http\Authenticators;
use App\Models\ZaloAcc;
use Illuminate\Support\Facades\Hash;

class ZaloAuth implements IAuth{

    public static function authenticate($array){
        $inputPhone = $array['phone']; 
        $inputPassword = $array['password'];

        $account = ZaloAcc::where('zaloPhone',$inputPhone)->first();
        if ($account == null) return -1;
        else if (Hash::check($inputPassword,$account->zaloPassword) == false) return -2;
        else return $account->zaloBalance;
    }
}

?>