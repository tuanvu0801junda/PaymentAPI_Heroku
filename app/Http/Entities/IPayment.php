<?php

namespace App\Http\Entities;
use Illuminate\Http\Request;

interface IPayment{
    function authenticate(Request $request);
    function subtract(Request $request);
    function getBalance(Request $request);

    // ************** NEW FUNCTION FOR BODY RAW REQUEST (BRR) **************
    function authenticateBRR(Request $request);
    function subtractBRR(Request $request);
    function getBalanceBRR(Request $request);

    // ************** NEW FUNCTION FOR VALIDATING CARD **************
    function validateCard(Request $request);
}
?>