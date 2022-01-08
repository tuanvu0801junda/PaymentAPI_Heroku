<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ZaloAcc extends Model{
    use HasFactory;
    protected $table = 'ZaloAcc';
    protected $fillable = [
        'zaloPhone',
        'zaloPassword',
        'zaloBalance',
    ];
    protected $primaryKey = 'zaloPhone';
}
