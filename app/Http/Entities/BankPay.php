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

        if ($account == null) return -1;
        else if (Hash::check($inputCvv, $account->bankCvv) == false) return -2;
        else if (strcmp($inputName,$account->bankName) != 0) return -3;
        else if (strcmp($inputExpired,$account->bankExpired) != 0) return -4;
        else return $account->bankBalance;
    }
    
    public function subtract(Request $request){
        $moneyAmount = $request->input('money');
        
        // errorCode 137: Not enough | 
        // errorCode 404: Not found  | 
        // errorCode 4061: Bank Cvv Code Incorrect  | 
        // errorCode 4062: Name of Card Owner Incorrect  | 
        // errorCode 4063: Bank ExpiredDate Incorrect  | 

        $balance = $this->getBalance($request);
        if($balance == -1){
            return response()->json([
                'status' => 404,
                'message' => 'Bank CardId Not Exist!'
            ]);
        } else if ($balance == -2){
            return response()->json([
                'status' => 4061, 
                'message' => 'Bank Cvv Code Incorrect!',
            ]);
        } else if ($balance == -3){
            return response()->json([
                'status' => 4062,
                'message' => 'Name of Bank Card Owner Incorrect!',
            ]);
        } else if ($balance == -4){
            return response()->json([
                'status' => 4063,
                'message' => 'Bank ExpiredDate Incorrect!'
            ]);            
        } else if ($balance < $moneyAmount){
            return response()->json([
                'status' => 137,
                'message' => 'Bank Balance not enough!'
            ]);
        } else {
            $balance = $balance - $moneyAmount;
            $account = BankAcc::where('bankCard',$request->input('card'))->first();
            $account->bankBalance = $balance;
            $account->update();
            return response()->json([
                'status' => 200,
                'message' => 'Payment via BankPay executed successfully!'
            ]);
        }
    }

    public function getBalance(Request $request){
        return $this->authenticate($request);
    }

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

    public function subtractBRR(Request $request){
        $moneyAmount = $request->money;
        
        // errorCode 137: Not enough | 
        // errorCode 404: Not found  | 
        // errorCode 4061: Bank Cvv Code Incorrect  | 
        // errorCode 4062: Name of Card Owner Incorrect  | 
        // errorCode 4063: Bank ExpiredDate Incorrect  | 

        $balance = $this->getBalanceBRR($request);
        if($balance == -1){
            return response()->json([
                'status' => 404,
                'message' => 'Bank CardId Not Exist!'
            ]);
        } else if ($balance == -2){
            return response()->json([
                'status' => 4061, 
                'message' => 'Bank Cvv Code Incorrect!',
            ]);
        } else if ($balance == -3){
            return response()->json([
                'status' => 4062,
                'message' => 'Name of Bank Card Owner Incorrect!',
            ]);
        } else if ($balance == -4){
            return response()->json([
                'status' => 4063,
                'message' => 'Bank ExpiredDate Incorrect!'
            ]);            
        } else if ($balance < $moneyAmount){
            return response()->json([
                'status' => 137,
                'message' => 'Bank Balance not enough!'
            ]);
        } else {
            $balance = $balance - $moneyAmount;
            $account = BankAcc::where('bankCard',$request->card)->first();
            $account->bankBalance = $balance;
            $account->update();
            return response()->json([
                'status' => 200,
                'message' => 'Payment via BankPay executed successfully!'
            ]);
        }
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