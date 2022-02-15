<?php

namespace App\Http\Controllers\brrPay;
use Illuminate\Http\Request;
use App\Http\Factories\brr\IBRRFactory;
use App\Http\Controllers\IPayControl;

interface IPayBRRControl extends IPayControl{

    function onlinePay(Request $request);

    function getBRRFactoryWithType($type): IBRRFactory;
}


?>