<?php

namespace App\Http\Entities;
use Illuminate\Http\Request;

interface IParamAuthenticator{
    function authenticate(Request $request);
   
    function getBalance(Request $request);
}
?>