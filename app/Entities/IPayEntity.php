<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

abstract class IPayEntity {
    private $money;

    public function setMoney($money){
        $this->money = $money;
    }

    abstract function subtract(Request $request);

    abstract function getBalance();

    abstract function encapsulate();
}