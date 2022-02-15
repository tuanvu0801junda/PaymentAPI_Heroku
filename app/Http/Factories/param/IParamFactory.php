<?php
namespace App\Http\Factories\param;
use Illuminate\Http\Request;
use App\Http\Entities\AbstractPayEntity;

interface IParamFactory{

    function createParamObjectFromRequest(Request $request): AbstractPayEntity;
}
?>