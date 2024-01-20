<?php

// app/Services/BestSellingProductsService.php

namespace App\Services;

use App\Models\BoutiqueModel;

class BoutiqueService
{

    public function getAllBoutiques()
    {
        $allBoutiques = BoutiqueModel::all();
        return $allBoutiques;
    }


}

