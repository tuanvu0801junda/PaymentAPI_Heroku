<?php

namespace App\Http\Factories\brr;
use Illuminate\Http\Request;
use App\Http\Entities\AbstractPayEntity;
use App\Http\Entities\ZaloPayEntity;

class ZaloBRRFactory implements IBRRFactory{
    
	function createBRRObjectFromRequest(Request $request): AbstractPayEntity {
        $zaloBRR = new ZaloPayEntity();
        $zaloBRR->setPhone($request->phone);
        $zaloBRR->setPassword($request->password);
        $zaloBRR->setMoney($request->money);
        return $zaloBRR;
        
	}
}
?>