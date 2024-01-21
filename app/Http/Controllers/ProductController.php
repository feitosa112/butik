<?php

namespace App\Http\Controllers;

use App\Models\ProductModel;

use Illuminate\Support\Facades\Session;

class ProductController extends Controller
{
    public function thisProduct($product_name,$id){
        $product = ProductModel::with('boutique')->find($id);


        return view('templates.thisProduct',compact('product'));
    }



public function cartView(){
    $cart = Session::get('cart',[]);
    $total = 0;
    foreach($cart as $product){
        $total+=$product->price;
    }
    return view('cart',compact('cart','total'));
}

    public function cartEmpty(){
        $cart = Session::get('cart',[]);

        Session::forget('cart');

    }



}
