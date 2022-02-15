<?php
namespace App\Http\Authenticators;

interface IAuth{

    public static function authenticate($array);
}
?>