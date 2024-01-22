<?php

use App\Http\Controllers\BoutiqueController;
use App\Http\Controllers\ProductController;
use App\Models\ProductModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome')->name('home');
});

Auth::routes();
Route::post('/add-to-cart/{id}', [ProductController::class, 'addToCart'])->name('addToCart');
Route::get('/cart', [ProductController::class, 'cartView'])->name('cartView');

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::post('{butik_name}',[BoutiqueController::class,'thisBoutique'])->name('thisBoutique');


    Route::get('/{product_name}/{id}', [ProductController::class, 'thisProduct'])->name('thisProduct');
    Route::get('/cart-empty', [ProductController::class, 'cartEmpty'])->name('cartEmpty');



