<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
            'p_name',
            'description',
            'image',
            'qty',
            'price',
            'color',
            'category_id',  
            'status',
        ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function productsfav()
    {
        return $this->hasMany(Product::class,'id','product_id');
    }
}
