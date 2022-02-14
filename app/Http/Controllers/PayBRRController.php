<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use IParamFactory;
use IBRRFactory;

class PayBRRController extends Controller implements IPayBRRControl{
        
	function onlinePay(Request $request) {
		$factory = $this->getBRRFactoryWithType($request->type);
		$account = $factory->createBRRObjectFromRequest($request);
		return $account->subtract($request);
	}
	
	
	function getBRRFactoryWithType($type): IBRRFactory{
        return IPayBRRControl::records[$type];
    }
}
