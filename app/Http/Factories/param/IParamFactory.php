<?php
namespace App\Http\Factories\param;
use Illuminate\Http\Request;
use App\Http\Entities\IPayEntity;

interface IParamFactory{

    function createParamObjectFromRequest(Request $request): IPayEntity;
}
?>