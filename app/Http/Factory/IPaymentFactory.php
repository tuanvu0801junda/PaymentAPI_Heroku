<?php
namespace App\Http\Factory;
use App\Http\Entities\IPayment;

interface IPaymentFactory{
    function createObjectFromRequest(): IPayment;
}


?>