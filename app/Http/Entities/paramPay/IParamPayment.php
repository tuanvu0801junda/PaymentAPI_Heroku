<?php

namespace App\Http\Entities;
use Illuminate\Http\Request;

interface IParamPayment{
    function subtract(Request $request);
}
?>