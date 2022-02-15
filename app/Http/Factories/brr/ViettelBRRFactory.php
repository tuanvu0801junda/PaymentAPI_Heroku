<?php

namespace App\Http\Factories\brr;
use Illuminate\Http\Request;
use App\Http\Entities\AbstractPayEntity;
use App\Http\Entities\ViettelPayEntity;

class ViettelBRRFactory implements IBRRFactory{
    
	function createBRRObjectFromRequest(Request $request): AbstractPayEntity {
        $viettelBRR = new ViettelPayEntity();
        $viettelBRR->setPhone($request->phone);
        $viettelBRR->setPassword($request->password);
        $viettelBRR->setMoney($request->money);
        return $viettelBRR;
        
	}
}
?>