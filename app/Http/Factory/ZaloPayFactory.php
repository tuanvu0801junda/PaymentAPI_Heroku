<?php
use App\Http\Entities\ZaloPay;

class ZaloPayFactory implements IPaymentFactory{
    public function createObjectFromRequest(){
        return new ZaloPay();
    }
}
?>