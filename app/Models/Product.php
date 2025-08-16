<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_name',
        'description',
        'mrp_price',
        'selling_price',
        'status'
    ];

    public function images()
    {
        return $this->hasMany(ProductImage::class, 'product_id');
    }
}
