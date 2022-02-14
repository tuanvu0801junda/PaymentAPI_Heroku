<?php
use Illuminate\Http\Request;
use App\Http\Controllers\IPayEntity;

interface IParamFactory{

    function createParamObjectFromRequest(Request $request): IPayEntity;
}
?>