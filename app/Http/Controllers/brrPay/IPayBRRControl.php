<?php

namespace App\Http\Controllers\brrPay;
use Illuminate\Http\Request;
use App\Http\Factories\brr\IBRRFactory;

interface IPayBRRControl{

    function onlinePay(Request $request);

    function getBRRFactoryWithType(Request $request): IBRRFactory;
}


?>