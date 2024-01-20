<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryModel extends Model
{
    protected $table = "categories";

    protected $fillable=[
        'categories_name'
    ];
    use HasFactory;

    public function products()
    {
        return $this->hasMany(ProductModel::class);
    }
}
