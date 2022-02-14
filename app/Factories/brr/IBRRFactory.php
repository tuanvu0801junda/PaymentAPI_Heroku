<?php
use Illuminate\Http\Request;
use App\Http\Controllers\IPayEntity;

interface IBRRFactory{

    function createBRRObjectFromRequest(Request $request): IPayEntity;
}
?>