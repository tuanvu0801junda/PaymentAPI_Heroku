<?php

namespace App\Http\Controllers\paramPay;
use Illuminate\Http\Request;
use App\Http\Factories\param\IParamFactory;

interface IPayParamControl{

    function onlinePay(Request $request);

    function getParamFactoryWithType(Request $request): IParamFactory;
}


?>