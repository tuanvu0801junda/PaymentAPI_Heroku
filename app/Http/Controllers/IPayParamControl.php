<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Factories\param\IParamFactory;

interface IPayParamControl{

    // const records = array(
    //     'bank' => new BankParamFactory(),
    //     'zalo' => new ZaloParamFactory(),
    //     'viettel' => new ViettelParamFactory(),
    // );

    function onlinePay(Request $request);

    function getParamFactoryWithType(Request $request): IParamFactory;
}


?>