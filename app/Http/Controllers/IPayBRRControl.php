<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use BankBRRFactory;
use ZaloBRRFactory;
use ViettelBRRFactory;
use IBRRFactory;

interface IPayBRRControl{

    const records = array(
        'bank' => new BankBRRFactory(),
        'zalo' => new ZaloBRRFactory(),
        'viettel' => new ViettelBRRFactory()
    );

    function onlinePay(Request $request);

    function getBRRFactoryWithType(Request $request): IBRRFactory;
}


?>