<?php

use Illuminate\Http\Request;
use App\Http\Controllers\IPayEntity;

class BankBRRFactory implements IBRRFactory{
    
	function createBRRObjectFromRequest(Request $request): IPayEntity {
        $bankBRR = new BankPayEntity();
        $bankBRR->setCardId($request->card);
        $bankBRR->setCvv($request->cvv);
        $bankBRR->setName($request->name);
        $bankBRR->setExpiredDate($request->expired);
        $bankBRR->setMoney($request->money);
        return $bankBRR;
	}
}
?>