<?php

namespace App\Http\Controllers;

use App\Models\ProductModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ProductController extends Controller
{
    public function thisProduct($product_name,$id){
        $product = ProductModel::with('boutique')->find($id);


        return view('templates.thisProduct',compact('product'));
    }

    public function addToCart(Request $request, $id)
{
    $request->validate([
        'size' => 'required',  // Dodajte ovo pravilo
        'quantity' => 'numeric|min:1',  // Primer pravila za količinu, ali možete dodati pravila po potrebi
    ]);


    $product = ProductModel::find($id);

    if ($request->has('size')) {
        $size = $request->input('size');
    } else {
        $size = null;
    }

    if ($request->has('quantity')) {
        $quantity = $request->input('quantity');
    } else {
        $quantity = 1;
    }

    if ($product) {
        $cart = Session::get('cart', []);

        // Provera da li proizvod sa istim ID-jem i veličinom već postoji u korpi
        $existingProduct = $cart[$id][$size] ?? null;

        if ($existingProduct) {
            // Ako već postoji, ažurirajte količinu
            $cart[$id][$size]['quantity'] += $quantity;
        } else {
            // Ako ne postoji, dodajte novi proizvod u korpu
            $cart[$id][$size] = [
                'product' => $product,
                'size' => $size,
                'quantity' => $quantity,
            ];
        }

        Session::put('cart', $cart);
        dd($cart);
        return redirect()->back()->with('success', 'Proizvod je dodat u korpu.');
    } else {
        return redirect()->back()->with('amount', 'Proizvoda nema trenutno na stanju');
    }
}

}
