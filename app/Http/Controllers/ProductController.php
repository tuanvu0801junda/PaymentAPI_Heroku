<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ProductController extends Controller{

    // public function subtractNumber(Request $request){
    //     $url = 'https://laptrinhcautrucapi.herokuapp.com/product/id?id=';
    //     $id = $request->input('id');
    //     $subtractNum = $request->input('number');

    //     $url = $url . '124123'; //change with $id
    //     $reply = Http::get($url);
    //     // return response()->json([
    //     //     'reply' => $reply->json(),
    //     // ]);

    //     $newQuantity = $reply->json()[0]['quantity'] - $subtractNum;
        
    //     $url = 'https://laptrinhcautrucapi.herokuapp.com/product/edit_product';
    //     $reply = Http::asForm()->post($url,[
    //         'id' => 124123, 
    //         'quantity' => 1280        
    //     ]);

    //     return response()->json([
    //         'reply' => $reply->json(),
    //     ]);
        
    // }

    public function subtractNumber(Request $request){
        $url = 'https://laptrinhcautrucapi.herokuapp.com/product/id?id=';
        $id = $request->input('id');
        $subtractNum = $request->input('number');

        $url = $url . $id;
        $reply = Http::get($url);
        if($reply->status() == 400){
            return response()->json([
                'status' => 404,
                'message' => 'Cannot get quantity from module Product'
            ]);
        }

        $newQuantity = $reply->json()[0]['quantity'] - $subtractNum;
        
        $url = 'https://laptrinhcautrucapi.herokuapp.com/product/edit_product';
        $reply = Http::asForm()->post($url,[
            'id' => $id, 
            'quantity' => $newQuantity
        ]);
        if($reply->status() == 400 | $reply->status() == 500){
            return response()->json([
                'status' => '400',
                'message' => 'Error happened. Cannot update product quantity'
            ]);    
        }
        if($reply->status() == 200){
            return response()->json([
                'status' => '200',
            ]);
        }
        
    }
}
