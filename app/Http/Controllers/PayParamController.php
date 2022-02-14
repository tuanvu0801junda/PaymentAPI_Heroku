<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use IParamFactory;

class PayParamController extends Controller implements IPayParamControl{
        
	function onlinePay(Request $request) {
		$factory = $this->getParamFactoryWithType($request->input('type'));
		$account = $factory->createParamObjectFromRequest($request);
		return $account->subtract($request);
	}
	
	
	function getParamFactoryWithType($type): IParamFactory{
		return IPayParamControl::records[$type];
	}
}
