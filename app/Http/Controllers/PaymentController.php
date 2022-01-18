<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Factory\BankPayFactory;
use App\Http\Factory\ViettelPayFactory;
use App\Http\Factory\ZaloPayFactory;
use App\Http\Factory\IPaymentFactory;

class PaymentController extends Controller{
    private $instance;
    private $records;

    private function setRecords() {
        $this->records['bank'] = new BankPayFactory();
        $this->records['viettel'] = new ViettelPayFactory();
        $this->records['zalo'] = new ZaloPayFactory();
    }

    public function onlinePay(Request $request){
        $this->setRecords();
        $factory = $this->getFactoryWithType($request->input('type'));
        $account = $factory->createObjectFromRequest();
        return $account->subtract($request);
    }

    public function onlinePayBRR(Request $request){
        $this->setRecords();
        $factory = $this->getFactoryWithType($request->type);
        $account = $factory->createObjectFromRequest();
        return $account->subtractBRR($request);
    }

    public function getFactoryWithType($type): IPaymentFactory{
        return $this->records[$type];
    }
    
    public function getInstance(){
        if ($this->instance == null) $this->instance = new PaymentController();
        return $this->instance;
    }
    
    public function show(){
        return response()->json([
            'type' => 'payment',
            'status' => 'almost done'
        ]);
    }
}
