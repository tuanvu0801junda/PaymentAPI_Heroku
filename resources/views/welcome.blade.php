<?php
use Illuminate\Support\Facades\DB;
use App\Models\BankAcc;
use App\Models\ViettelAcc;
use App\Models\ZaloAcc;
use Illuminate\Support\Facades\Hash;

function insertRandom(){
    $acc1 = new BankAcc();
    $acc1->bankCard = '123456';
    $acc1->bankName = 'Tuan Vu';
    $acc1->bankCvv = Hash::make('1234');
    $acc1->bankExpired = '10/26';
    $acc1->save();

    $acc1 = new BankAcc();
    $acc1->bankCard = '123457';
    $acc1->bankName = 'Long Hoang';
    $acc1->bankCvv = Hash::make('2345');
    $acc1->bankExpired = '10/27';
    $acc1->save();

    $acc1 = new BankAcc();
    $acc1->bankCard = '123458';
    $acc1->bankName = 'Ngoc Tran';
    $acc1->bankCvv = Hash::make('3456');
    $acc1->bankExpired = '10/28';
    $acc1->save();

    $acc1 = new BankAcc();
    $acc1->bankCard = '123459';
    $acc1->bankName = 'Hieu Tran';
    $acc1->bankCvv = Hash::make('5678');
    $acc1->bankExpired = '10/29';
    $acc1->save();
?>