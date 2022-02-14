<?php

use Illuminate\Http\Request;
use App\Http\Controllers\IPayEntity;

class ViettelParamFactory implements IParamFactory{

    public function createParamObjectFromRequest(Request $request): IPayEntity{
        $paramViettel = new ViettelPayEntity();
        $paramViettel->setPhone($request->input('phone'));
        $paramViettel->setPassword($request->input('password'));
        $paramViettel->setMoney($request->input('money'));
        return $paramViettel;
    }
}

?>