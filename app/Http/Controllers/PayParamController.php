<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Factories\param\IParamFactory;
use App\Http\Factories\param\ZaloParamFactory;
use App\Http\Factories\param\ViettelParamFactory;
use App\Http\Factories\param\BankParamFactory;

class PayParamController extends Controller implements IPayParamControl{
    
	private $records;

	public function __construct(){
		$this->records['bank'] = new BankParamFactory();
		$this->records['zalo'] = new ZaloParamFactory();
		$this->records['viettel'] = new ViettelParamFactory();
	}
	
	function onlinePay(Request $request) {
		$factory = $this->getParamFactoryWithType($request->input('type'));
		$account = $factory->createParamObjectFromRequest($request);
		return $account->subtract($request);
	}
	
	
	function getParamFactoryWithType($type): IParamFactory{
		return $this->records[$type];
	}
}
