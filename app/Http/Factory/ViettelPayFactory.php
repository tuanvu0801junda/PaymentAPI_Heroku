<?php
namespace App\Http\Factory;
use App\Http\Entities\IPayment;
use App\Http\Entities\ViettelPay;

class ViettelPayFactory implements IPaymentFactory{
    public function createObjectFromRequest(): IPayment{
        return new ViettelPay();
    }
}
?>
