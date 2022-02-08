<?php

namespace App\Http\Entities;
use Illuminate\Http\Request;
use App\Models\BankAcc;
use Illuminate\Support\Facades\Hash;

class BankBRRAuth implements IBRRAuthenticator{

    // ************** NEW FUNCTION FOR BODY RAW REQUEST (BRR) **************
    public function authenticateBRR(Request $request){
        $inputCard = $request->card;
        $inputName = $request->name;
        $inputCvv = $request->cvv;
        $inputExpired = $request->expired;

        $account = BankAcc::where('bankCard',$inputCard)->first();

        if ($account == null) return -1;
        else if (Hash::check($inputCvv, $account->bankCvv) == false) return -2;
        else if (strcmp($inputName,$account->bankName) != 0) return -3;
        else if (strcmp($inputExpired,$account->bankExpired) != 0) return -4;
        else return $account->bankBalance;
    }

    public function getBalanceBRR(Request $request){
        return $this->authenticateBRR($request);
    }

    public function validateCard(Request $request){
        $check = $this->authenticateBRR($request);
        if($check == -1){
            return response()->json([
                'status' => 404,
                'message' => 'Bank CardId Not Exist!'
            ]);
        } else if ($check == -2){
            return response()->json([
                'status' => 4061, 
                'message' => 'Bank Cvv Code Incorrect!',
            ]);
        } else if ($check == -3){
            return response()->json([
                'status' => 4062,
                'message' => 'Name of Bank Card Owner Incorrect!',
            ]);
        } else if ($check == -4){
            return response()->json([
                'status' => 4063,
                'message' => 'Bank ExpiredDate Incorrect!'
            ]);            
        } else {
            return response()->json([
                'status' => 200,
                'message' => 'BankPay Account validated successfully!'
            ]);
        }
    }

}
?>