<?php
namespace App\Http\Entities;
use App\Http\Entities\AbstractPayEntity;
use Illuminate\Http\Request;
use App\Models\BankAcc;
use App\Http\Authenticators\BankAuth;

class BankPayEntity extends AbstractPayEntity{

    private $cvv;
    private $expired;
    private $name;
    private $cardId;

    public function setCvv($cvv){
        $this->cvv = $cvv;
    }

    public function setExpiredDate($expired){
        $this->expired = $expired;
    }

    public function setName($name){
        $this->name = $name;
    }

    public function setCardId($cardId){
        $this->cardId = $cardId;
    }

    public function subtract(Request $request){
        // errorCode 137: Not enough 
        // errorCode 404: Not found  
        // errorCode 4061: Bank Cvv Code Incorrect  
        // errorCode 4062: Name of Card Owner Incorrect  
        // errorCode 4063: Bank ExpiredDate Incorrect  

        $balance = $this->getBalance();
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
        } else if ($balance < $this->money){
            return response()->json([
                'status' => 137,
                'message' => 'Bank Balance not enough!'
            ]);
        } else {
            $balance = $balance - $this->money;
            $account = BankAcc::where('bankCard', $this->cardId)->first();
            $account->bankBalance = $balance;
            $account->update();
            return response()->json([
                'status' => 200,
                'message' => 'Payment via BankPay executed successfully!'
            ]);
        }
    }

    public function encapsulate(){
        return array(
            'cvv' => $this->cvv,
            'name' => $this->name,
            'expired' => $this->expired,
            'card' => $this->cardId
        );
    }

    public function getBalance(){
        $array = $this->encapsulate();
        return BankAuth::authenticate($array);
    }
}

?>