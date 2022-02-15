<?php

namespace App\Http\Controllers\paramPay;
use Illuminate\Http\Request;
use App\Http\Factories\param\IParamFactory;
use App\Http\Controllers\IPayControl;

interface IPayParamControl extends IPayControl{

    function onlinePay(Request $request);

    function getParamFactoryWithType($type): IParamFactory;
}


?>