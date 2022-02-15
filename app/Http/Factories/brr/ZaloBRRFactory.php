<?php

namespace App\Http\Factories\brr;
use Illuminate\Http\Request;
use App\Http\Entities\IPayEntity;
use App\Http\Entities\ZaloPayEntity;

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