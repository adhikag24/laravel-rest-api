<?php

namespace App\Http\Controllers;
// use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{

    function getById($id)
    {
        $data = Product::where('id', $id)->get();

        return response()->json(
            [
                 'data'  => $data
            ]
        );
    }

    function post(Request $request)
    {
        $product = new Product;
        $product->name = $request->name;
        $product->price = $request->price;
        $product->quantity = $request->quantity;
        $product->active = $request->active;
        $product->description = $request->description;

        $product->save();

        return response()->json(
            [
                'message'   => "Success",
                'data'      => $product
            ]
        );
    }

    function get()
    {
        $data = Product::all();

        return response()->json(
            [
                'message'   => "get",
                'data' =>  $data
            ]
        );
    }


    function put($id, Request $request)
    {
       $product = Product::where('id', $id)->first();
       if($product){
        $product->name = $request->name ? $request->name : $product->name;
        $product->price = $request->price ? $request->price : $product->price;
        $product->quantity = $request->quantity ? $request->quantity : $product->quantity;
        $product->active = $request->active ? $request->active : $product->active;
        $product->description = $request->description ? $request->description : $product->description;

        $product->save();
            return response()->json(
                [
                    'message'   => "Success " ,
                    'data'      => $product
                ]
            );
       } 
       else{
        return response()->json(
            [
                'message'   => "Product with id ".$id." not found."
            ],400
        );
       }

       
    }

    function delete($id)
    {
        $product = Product::where('id', $id)->first();
        if($product){
            $product->delete();
            return response()->json(
                [
                    'message'   => "Product with id ".$id." deleted."
                ]
            );
        } 
        else{
            return response()->json(
                [
                    'message'   => "Product not found"
                ],400
            );
        }
        
    }
}
