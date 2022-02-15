<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Factories\brr\IBRRFactory;
use App\Http\Factories\brr\BankBRRFactory;
use App\Http\Factories\brr\ZaloBRRFactory;
use App\Http\Factories\brr\ViettelBRRFactory;

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
