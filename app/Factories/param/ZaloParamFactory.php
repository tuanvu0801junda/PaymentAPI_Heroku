<?php

use Illuminate\Http\Request;
use App\Http\Controllers\IPayEntity;

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