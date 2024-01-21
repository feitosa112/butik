<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BoutiqueModel extends Model
{
    protected $table = 'butik';

    protected $fillable = [
        'butik_name',
        'address',
        'image',
        'phone',
        'email',
    ];
    use HasFactory;

    public function products()
    {
        return $this->hasMany(ProductModel::class);
    }
}
