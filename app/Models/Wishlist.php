<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{
    use HasFactory;

    protected $fillable = [
            'product_id',
            'user_id'
        ];

    public function productsfav()
    {
        return $this->belongsTo(Product::class,'product_id','id');
    }

    // public function productsfav()
    // {
    //     return $this->hasMany(Product::class,'id','user_id');
    // }
}
