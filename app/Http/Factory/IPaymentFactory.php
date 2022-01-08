<?php
use App\Http\Entities\IPayment;

interface IPaymentFactory{
    function createObjectFromRequest(): IPayment;
}


?>