<?php
namespace App\Http\Factories\brr;
use App\Http\Entities\IPayEntity;
use Illuminate\Http\Request;

interface IBRRFactory{

    function createBRRObjectFromRequest(Request $request): IPayEntity;
}
?>