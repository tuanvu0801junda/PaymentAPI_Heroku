<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use BankParamFactory;
use ZaloParamFactory;
use ViettelParamFactory;
use IParamFactory;

interface IPayParamControl{

    const records = array(
        'bank' => new BankParamFactory(),
        'zalo' => new ZaloParamFactory(),
        'viettel' => new ViettelParamFactory(),
    );

    function onlinePay(Request $request);

    function getParamFactoryWithType(Request $request): IParamFactory;
}


?>