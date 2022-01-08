<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use BankPayFactory;
use ViettelPayFactory;
use ZaloPayFactory;
use IPaymentFactory;

class PaymentController extends Controller{
    private $instance;
    private $records;

    private function __construct() {
        $this->records['bank'] = new BankPayFactory();
        $this->records['viettel'] = new ViettelPayFactory();
        $this->records['zalo'] = new ZaloPayFactory();
    }

    public function onlinePay(Request $request){
        $factory = $this->getFactoryWithType($request->input('type'));
        $account = $factory->createObjectFromRequest();
        return $account->subtract($request);
    }

    public function getFactoryWithType($type): IPaymentFactory{
        return $this->records[$type];
    }
    
    public function getInstance(){
        if ($this->instance == null) $this->instance = new PaymentController();
        return $this->instance;
    }
    
}
