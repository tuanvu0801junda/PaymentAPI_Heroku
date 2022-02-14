<?php
use Illuminate\Http\Request;

interface IAuth{

    public static function authenticate($array);
}
?>