<?php

// app/Services/BestSellingProductsService.php

namespace App\Services;

use App\Models\CategoryModel;
use App\Models\OrderItemModel;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class CategoriesService
{
    private $olderItem;


    /**
     * Dobijanje najprodavanijih proizvoda.
     *
     * @param int $limit
     * @return \Illuminate\Support\Collection
     */
    public function getAllcategories()
    {
        $allCategories = CategoryModel::all();
        return $allCategories;
    }

    /**

     *
     * @param \Illuminate\Support\Collection $results
     * @return \Illuminate\Support\Collection
     */
    protected function formatResults(Collection $results)
    {
        return $results->map(function ($result) {
            return [
                'product' => $result->product,
                // 'total_quantity' => $result->total_quantity,
            ];
        });
    }
}

