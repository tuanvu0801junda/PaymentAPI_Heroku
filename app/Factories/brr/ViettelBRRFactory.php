<?php

use Illuminate\Http\Request;
use App\Http\Controllers\IPayEntity;

class ViettelBRRFactory implements IBRRFactory{
    
	function createBRRObjectFromRequest(Request $request): IPayEntity {
        $viettelBRR = new ViettelPayEntity();
        $viettelBRR->setPhone($request->phone);
        $viettelBRR->setPassword($request->password);
        $viettelBRR->setMoney($request->money);
        return $viettelBRR;
        
	}
}
?>