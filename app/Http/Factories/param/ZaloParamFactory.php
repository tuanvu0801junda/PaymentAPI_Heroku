<?php

namespace App\Http\Factories\param;
use App\Http\Entities\IPayEntity;
use App\Http\Entities\ZaloPayEntity;
use Illuminate\Http\Request;

class ZaloParamFactory implements IParamFactory{

    public function createParamObjectFromRequest(Request $request): IPayEntity{
        $paramZalo = new ZaloPayEntity();
        $paramZalo->setPhone($request->input('phone'));
        $paramZalo->setPassword($request->input('password'));
        $paramZalo->setMoney($request->input('money'));
        return $paramZalo;
    }
}

?>