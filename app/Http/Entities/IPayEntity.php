<?php

namespace App\Http\Entities;

use Illuminate\Http\Request;

abstract class IPayEntity {
    protected $money;

    public function setMoney($money){
        $this->money = $money;
    }

    abstract function subtract(Request $request);

    abstract function getBalance();

    abstract function encapsulate();
}