<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductVariant extends Model
{
    use HasFactory;

    public $fillable = [
        'product_id',
        'color',
        'price',
        'quantity',
        'discount',
    ];

    public function productMultiVariant(){
        return $this->hasMany(ProductVariant::class, 'id','product_id');
    }
}
