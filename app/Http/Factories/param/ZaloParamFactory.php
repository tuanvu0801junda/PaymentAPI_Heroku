<?php

namespace App\Http\Factories\param;
use App\Http\Entities\AbstractPayEntity;
use App\Http\Entities\ZaloPayEntity;
use Illuminate\Http\Request;

class ZaloParamFactory implements IParamFactory{

    public function createParamObjectFromRequest(Request $request): AbstractPayEntity{
        $paramZalo = new ZaloPayEntity();
        $paramZalo->setPhone($request->input('phone'));
        $paramZalo->setPassword($request->input('password'));
        $paramZalo->setMoney($request->input('money'));
        return $paramZalo;
    }
}

?>