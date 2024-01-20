<?php

// app/Services/BestSellingProductsService.php

namespace App\Services;

use App\Models\CategoryModel;
use App\Models\OrderItemModel;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class CategoriesService
{

    public function getAllcategories()
    {
        $allCategories = CategoryModel::all();
        return $allCategories;
    }



}

