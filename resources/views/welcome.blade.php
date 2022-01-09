<?php
use Illuminate\Support\Facades\DB;
use App\Models\ZaloAcc;
use App\Models\BankAcc;
use App\Models\ViettelAcc;
use Illuminate\Support\Facades\Hash;

function insertData(){
    $acc1 = new ZaloAcc();
    $acc1->zaloPhone = '0123789456';
    $acc1->zaloPassword = Hash::make('abcxyz');
    $acc1->zaloBalance = 1500000;
    $acc1->save();

    $acc1 = new ViettelAcc();
    $acc1->viettelPhone = '0123789456';
    $acc1->viettelPassword = Hash::make('abcxyz');
    $acc1->viettelBalance = 1500000;
    $acc1->save();

    $acc1 = new BankAcc();
    $acc1->bankCard = '123459';
    $acc1->bankName = 'HuongVi_HoangMinh';
    $acc1->bankCvv = Hash::make('4590');
    $acc1->bankExpired = '10/27';
    $acc1->bankBalance = 1500000;
    $acc1->save();
}

insertData();
?>