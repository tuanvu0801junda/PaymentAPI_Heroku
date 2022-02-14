<?php

use Illuminate\Http\Request;
use App\Http\Controllers\IPayEntity;

class ZaloBRRFactory implements IBRRFactory{
    
	function createBRRObjectFromRequest(Request $request): IPayEntity {
        $zaloBRR = new ZaloPayEntity();
        $zaloBRR->setPhone($request->phone);
        $zaloBRR->setPassword($request->password);
        $zaloBRR->setMoney($request->money);
        return $zaloBRR;
        
	}
}
?>