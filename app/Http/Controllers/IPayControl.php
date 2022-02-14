<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

interface IPayControl{

    function onlinePay(Request $request);
}


?>