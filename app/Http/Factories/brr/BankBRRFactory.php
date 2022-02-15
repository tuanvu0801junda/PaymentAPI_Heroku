<?php
namespace App\Http\Factories\brr;
use Illuminate\Http\Request;
use App\Http\Entities\AbstractPayEntity;
use App\Http\Entities\BankPayEntity;

class BankBRRFactory implements IBRRFactory{
    
	function createBRRObjectFromRequest(Request $request): AbstractPayEntity {
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