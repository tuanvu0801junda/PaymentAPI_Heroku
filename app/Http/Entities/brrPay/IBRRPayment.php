<?php

namespace App\Http\Entities;
use Illuminate\Http\Request;

interface IBRRPayment{
    function subtractBRR(Request $request);
}
?>