<?php

namespace App\Http\Factory;
use App\Http\Entities\ZaloPay;
use App\Http\Entities\IPayment;

class ZaloPayFactory implements IPaymentFactory{
    public function createObjectFromRequest(): IPayment{
        return new ZaloPay();
    }
}
?>