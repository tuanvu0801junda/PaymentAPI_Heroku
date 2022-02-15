<?php
namespace App\Http\Factories\brr;
use Illuminate\Http\Request;
use App\Http\Entities\AbstractPayEntity;

interface IBRRFactory{

    function createBRRObjectFromRequest(Request $request): AbstractPayEntity;
}
?>