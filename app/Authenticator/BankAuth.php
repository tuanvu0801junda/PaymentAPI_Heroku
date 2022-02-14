<?php
use App\Models\BankAcc;
use Illuminate\Support\Facades\Hash;

class BankAuth implements IAuth{

    public static function authenticate($array){
        $inputCard = $array['card'];
        $inputName = $array['name'];
        $inputCvv = $array['cvv'];
        $inputExpired = $array['expired'];

        $account = BankAcc::where('bankCard',$inputCard)->first();

        if ($account == null) return -1;
        else if (Hash::check($inputCvv, $account->bankCvv) == false) return -2;
        else if (strcmp($inputName,$account->bankName) != 0) return -3;
        else if (strcmp($inputExpired,$account->bankExpired) != 0) return -4;
        else return $account->bankBalance;
    }
}

?>