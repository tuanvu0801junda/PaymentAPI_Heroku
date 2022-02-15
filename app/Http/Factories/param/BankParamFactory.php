<?php
namespace App\Http\Factories\param;
use Illuminate\Http\Request;
use App\Http\Entities\IPayEntity;
use App\Http\Entities\BankPayEntity;
use App\Http\Factories\param\IParamFactory;


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