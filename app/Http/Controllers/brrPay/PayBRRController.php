<?php

namespace App\Http\Controllers\brrPay;

use Illuminate\Http\Request;
use App\Http\Factories\brr\IBRRFactory;
use App\Http\Factories\brr\BankBRRFactory;
use App\Http\Factories\brr\ZaloBRRFactory;
use App\Http\Factories\brr\ViettelBRRFactory;
use App\Http\Controllers\brrPay\IPayBRRControl;
use App\Http\Controllers\Controller;

class PayBRRController extends Controller implements IPayBRRControl{

	private $records;

	public function __construct(){
		$this->records['bank'] = new BankBRRFactory();
		$this->records['zalo'] = new ZaloBRRFactory();
		$this->records['viettel'] = new ViettelBRRFactory();
	}
        
	function onlinePay(Request $request) {
		$factory = $this->getBRRFactoryWithType($request->type);
		$account = $factory->createBRRObjectFromRequest($request);
		return $account->subtract($request);
	}
	
	
	function getBRRFactoryWithType($type): IBRRFactory{
        return $this->records[$type];
    }
}
