<?php
namespace App\Http\Entities;
use App\Http\Entities\IPayEntity;
use Illuminate\Http\Request;
use App\Models\ViettelAcc;
use App\Http\Authenticators\ViettelAuth;

class ViettelPayEntity extends IPayEntity{
    private $phone;
    private $password;
    
    public function setPhone($phone){
        $this->phone = $phone;
    }

    public function setPassword($password){
        $this->password = $password;
    }

    public function subtract(Request $request){
        // errorCode 137: Not enough | 
        // errorCode 404: Not found  | 
        // errorCode 406: incorrect  | 

        $balance = $this->getBalance();
        if ($balance == -1){
            return response()->json([
                'status' => 404,
                'message' => 'ViettelPay Account Not Exist',
            ]);
        } else if ($balance == -2){
            return response()->json([
                'status' => 406,
                'message' => 'ViettelPay Password Incorrect!'
            ]);
        } else if ($balance < $this->money){
            return response()->json([
                'status' => 137,
                'message' => 'ViettelPay Balance not enough!'
            ]);
        } else {
            $balance = $balance - $this->money;
            $account = ViettelAcc::where('viettelPhone', $this->phone)->first();
            $account->viettelBalance = $balance;
            $account->update();
            return response()->json([
                'status' => 200,
                'message' => 'Payment by ViettelPay executed successfully!'
            ]);
        }
    }

    public function encapsulate(){
        return array(
            'phone' => $this->phone,
            'password' => $this->password
        );
    }

    public function getBalance(){
        $array = $this->encapsulate();
        return ViettelAuth::authenticate($array);
    }
}


?>