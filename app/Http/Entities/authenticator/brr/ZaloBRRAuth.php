<?php

namespace App\Http\Entities;
use Illuminate\Http\Request;
use App\Models\ZaloAcc;
use Illuminate\Support\Facades\Hash;

class ZaloBRRAuth implements IBRRAuthenticator{
    // ************** NEW FUNCTION FOR BODY RAW REQUEST (BRR) **************

    public function authenticateBRR(Request $request){
        $inputPhone = $request->phone;
        $inputPassword = $request->password;

        $account = ZaloAcc::where('zaloPhone',$inputPhone)->first();
        if ($account == null) return -1;
        else if (Hash::check($inputPassword,$account->zaloPassword) == false) return -2;
        else return $account->zaloBalance;
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
                'message' => 'ZaloPay Account Not Exist',
            ]);
        } else if ($check == -2){
            return response()->json([
                'status' => 406,
                'message' => 'ZaloPay Password Incorrect!'
            ]);
        } else {
            return response()->json([
                'status' => 200,
                'message' => 'ZaloPay Account validated successfully!'
            ]);
        }
    }
}
?>