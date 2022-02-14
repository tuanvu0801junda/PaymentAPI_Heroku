<?php

use Illuminate\Http\Request;
use App\Http\Controllers\IPayEntity;

class BankParamFactory implements IParamFactory{

    public function createParamObjectFromRequest(Request $request): IPayEntity{
        $paramBank = new BankPayEntity();
        $paramBank->setCardId($request->input('card'));
        $paramBank->setCvv($request->input('cvv'));
        $paramBank->setExpiredDate($request->input('expired'));
        $paramBank->setName($request->input('name'));
        $paramBank->setMoney($request->input('money'));
        return $paramBank;
    }
}

?>