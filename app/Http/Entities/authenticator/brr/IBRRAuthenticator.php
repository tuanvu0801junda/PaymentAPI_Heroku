<?php

namespace App\Http\Entities;
use Illuminate\Http\Request;

interface IBRRAuthenticator{
    function authenticateBRR(Request $request);
   
    function getBalanceBRR(Request $request);

    // ************** NEW FUNCTION FOR VALIDATING CARD **************
    function validateCard(Request $request);
}
?>