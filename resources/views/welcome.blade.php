<?php
use Illuminate\Support\Facades\DB;
use App\Models\ZaloAcc;
use Illuminate\Support\Facades\Hash;

function insertRandom(){
    $acc1 = new ZaloAcc();
    $acc1->zaloPhone = '1234567890';
    $acc1->zaloPassword = Hash::make('123456');
    $acc1->zaloBalance = 1500000;
    $acc1->save();

    $acc1 = new ZaloAcc();
    $acc1->zaloPhone = '1234567891';
    $acc1->zaloPassword = Hash::make('123457');
    $acc1->zaloBalance = 1500000;
    $acc1->save();

    $acc1 = new ZaloAcc();
    $acc1->zaloPhone = '1234567892';
    $acc1->zaloPassword = Hash::make('123458');
    $acc1->zaloBalance = 1500000;
    $acc1->save();

    $acc1 = new ZaloAcc();
    $acc1->zaloPhone = '1234567893';
    $acc1->zaloPassword = Hash::make('123459');
    $acc1->zaloBalance = 1500000;
    $acc1->save();

    echo "<h2>Add db zalo successfully!</h2>";
}

insertRandom();
?>