<?php

namespace App\Http\Controllers;

use App\Models\ProductModel;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function thisProduct($product_name,$id){
        $product = ProductModel::with('boutique')->find($id);


        return view('templates.thisProduct',compact('product'));
    }
}