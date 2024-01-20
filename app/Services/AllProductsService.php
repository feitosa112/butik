<?php

// app/Services/BestSellingProductsService.php

namespace App\Services;

use App\Models\ProductModel;

class AllProductsService
{

    public function getAllProducts()
    {
        $allProducts = ProductModel::with('category')->get();
        return $allProducts;
    }


}
