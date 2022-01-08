<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ViettelAcc extends Model{
    use HasFactory;
    protected $table = 'ViettelAcc';
    protected $fillable = [
        'viettelPhone',
        'viettelPassword',
        'viettelBalance',
    ];
    protected $primaryKey = 'viettelPhone';
}
