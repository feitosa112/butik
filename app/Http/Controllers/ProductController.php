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
            'size' => 'required|in:S,L,XL,XXL',
        ]);

        // Find the product by ID
        $product = ProductModel::find($id);

        if (!$product) {
            return redirect()->back()->with('error', 'Product not found');
        }

        // Create a unique identifier for the cart item (combination of product ID and size)
        $cartItemId = $id . '_' . $request->input('size');

        // Check if the cart session key exists
        if (!Session::has('cart')) {
            Session::put('cart', []);
        }
        $cart = Session::get('cart');

        // Check if the item is already in the cart
        if (array_key_exists($cartItemId, $cart)) {
            // If yes, increment the quantity
            $cart[$cartItemId]['quantity']++;
        } else {
            // If not, add the product to the cart
            $cart[$cartItemId] = [
                'id' => $product->id,
                'name' => $product->product_name,
                'price' => $product->price,
                'image'=>$product->img1,
                'size' => $request->input('size'),
                'quantity' => 1,
            ];
        }

        // Update the cart in the session
        Session::put('cart', $cart);

        return redirect()->back()->with('success', 'Product added to cart');
    }



    public function cartView(){
        $cart = Session::get('cart',[]);

        return view('cart',compact('cart'));
    }


    public function deleteProductFromCart(Request $request,$id) {
        $size = $request->input('size');
        $cart = Session::get('cart',[]);
        if (isset($cart[$id.'_'.$size])){
            unset($cart[$id.'_'.$size]);

            Session::put('cart', $cart);
            return redirect()->back()->with('deleteFromCart', 'Uspješno ste obrisali proizvod iz korpe');
        }else{
            return redirect()->back()->with('errorDeleteFromCart', 'Greška, pokušajte ponovno');
        }

    }



    public function cartEmpty(){
        $cart = Session::get('cart',[]);

        Session::forget('cart');

        return redirect()->back()->with('cartEmpty','Ispraznili ste korpu,zapocnite novu kupovinu');

    }

    public function checkoutView(Request $request){
        $productId = $request->input('productId');
    $size = $request->input('size');

    $quantity = $request->input('quantity_'.$productId.'_'.$size);

    // Ažuriranje količine u korpi (ovde implementirajte kako želite)
    // Na primer, možete koristiti Session::put() ili ažurirati bazu podataka
    // U ovom primeru, koristiću Session::put() za ilustraciju
    $cart = Session::get('cart', []);

    $cartKey = $productId . '_' . $size;

    if (array_key_exists($cartKey, $cart)) {
        $cart[$cartKey]['quantity'] = $quantity;
        Session::put('cart', $cart);

        return view('checkout',compact('cart'));

    }

    return response()->json(['success' => false, 'message' => 'Proizvod nije pronađen u korpi.']);
}



}
