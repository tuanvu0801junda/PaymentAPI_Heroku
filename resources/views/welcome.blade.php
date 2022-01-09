<?php
use Illuminate\Support\Facades\DB;
use App\Models\ZaloAcc;
use App\Models\BankAcc;
use App\Models\ViettelAcc;
use Illuminate\Support\Facades\Hash;

function insertData(){
    $acc1 = new BankAcc();
    $acc1->bankCard = '123567';
    $acc1->bankName = 'HuongVi_HoangMinh';
    $acc1->bankCvv = Hash::make('4590');
    $acc1->bankExpired = '10/27';
    $acc1->bankBalance = 1600000;
    $acc1->save();
}

insertData();
?>