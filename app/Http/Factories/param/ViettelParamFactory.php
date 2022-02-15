<?php

namespace App\Http\Factories\param;
use App\Http\Entities\IPayEntity;
use App\Http\Entities\ViettelPayEntity;
use Illuminate\Http\Request;

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