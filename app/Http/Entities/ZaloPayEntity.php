<?php
namespace App\Http\Entities;
use App\Http\Entities\AbstractPayEntity;
use Illuminate\Http\Request;
use App\Models\ZaloAcc;
use App\Http\Authenticators\ZaloAuth;

class ZaloPayEntity extends AbstractPayEntity{

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
        if($balance == -1){
            return response()->json([
                'status' => 404,
                'message' => 'ZaloPay Account Not Exist',
            ]);
        } else if ($balance == -2){
            return response()->json([
                'status' => 406,
                'message' => 'ZaloPay Password Incorrect!'
            ]);
        } else if ($balance < $this->money){
            return response()->json([
                'status' => 137,
                'message' => 'ZaloPay Balance not enough!'
            ]);
        } else {
            $balance = $balance - $this->money;
            $account = ZaloAcc::where('zaloPhone',$this->phone)->first();
            $account->zaloBalance = $balance;
            $account->update();
            return response()->json([
                'status' => 200,
                'message' => 'Payment by ZaloPay executed successfully!'
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
        return ZaloAuth::authenticate($array);
    }
}


?>