<?php
use Illuminate\Support\Facades\DB;
use App\Models\ViettelAcc;
use App\Models\ZaloAcc;
use Illuminate\Support\Facades\Hash;

function insertRandom(){
    $acc1 = new ViettelAcc();
    $acc1->viettelPhone = '1234567890';
    $acc1->viettelPassword = Hash::make('123456');
    $acc1->viettelBalance = 1500000;
    $acc1->save();

    $acc1 = new ViettelAcc();
    $acc1->viettelPhone = '1234567891';
    $acc1->viettelPassword = Hash::make('123457');
    $acc1->viettelBalance = 1500000;
    $acc1->save();

    $acc1 = new ViettelAcc();
    $acc1->viettelPhone = '1234567892';
    $acc1->viettelPassword = Hash::make('123458');
    $acc1->viettelBalance = 1500000;
    $acc1->save();

    $acc1 = new ViettelAcc();
    $acc1->viettelPhone = '1234567893';
    $acc1->viettelPassword = Hash::make('123459');
    $acc1->viettelBalance = 1500000;
    $acc1->save();

    echo "<h2>Add db successfully!</h2>";
}

insertRandom();
?>