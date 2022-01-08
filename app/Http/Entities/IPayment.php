<?php

namespace App\Http\Entities;
use Illuminate\Http\Request;

interface IPayment{
    function authenticate(Request $request);
    function subtract(Request $request);
    function getBalance(Request $request);
}
?>