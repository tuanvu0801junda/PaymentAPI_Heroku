<?php
use App\Http\Entities\IPayment;
use App\Http\Entities\BankPay;

class BankPayFactory implements IPaymentFactory{
    public function createObjectFromRequest(): IPayment{
        return new BankPay();
    }
}

?>