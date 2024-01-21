<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductModel extends Model
{
    protected $table = 'products';

    protected $fillable = [
        'product_name',
        'description',
        'mark',
        'price',
        'img1',
        'img2',
        'img3',
        'boutique_id',
        'category_id',


    ];
    use HasFactory;

    public function category()
    {
        return $this->belongsTo(CategoryModel::class);
    }

    public function boutique(){
        return $this->belongsTo(BoutiqueModel::class);
    }
}
