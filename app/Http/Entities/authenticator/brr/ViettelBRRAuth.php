<?php

namespace App\Http\Entities;
use Illuminate\Http\Request;
use App\Models\ViettelAcc;
use Illuminate\Support\Facades\Hash;

class ViettelBRRAuth implements IBRRAuthenticator{

    // ************** NEW FUNCTION FOR BODY RAW REQUEST (BRR) **************
    public function authenticateBRR(Request $request){
        $inputPhone = $request->phone;
        $inputPassword = $request->password;

        $account = ViettelAcc::where('viettelPhone',$inputPhone)->first();
        if ($account == null) return -1;
        else if (Hash::check($inputPassword,$account->viettelPassword) == false) return -2;
        else return $account->viettelBalance;
    }

    public function getBalanceBRR(Request $request){
        return $this->authenticateBRR($request);
    }

    // ************** NEW FUNCTION FOR VALIDATING CARD **************
    public function validateCard(Request $request){
        $check = $this->authenticateBRR($request);
        if ($check == -1){
            return response()->json([
                'status' => 404,
                'message' => 'ViettelPay Account Not Exist',
            ]);
        } else if ($check == -2){
            return response()->json([
                'status' => 406,
                'message' => 'ViettelPay Password Incorrect!'
            ]);
        } else {
            return response()->json([
                'status' => 200,
                'message' => 'ViettelPay Account validated successfully!'
            ]);
        }
    }
}
?>
