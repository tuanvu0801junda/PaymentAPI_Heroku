<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BankAcc extends Model{
    use HasFactory;
    protected $table = 'BankAcc';
    protected $fillable = [
        'bankCard',
        'bankName',
        'bankCvv',
        'bankExpired',
        'bankBalance',
    ];
    protected $primaryKey = 'bankCard';
}
