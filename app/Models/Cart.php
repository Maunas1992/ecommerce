<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = [
            'qty',
            'color',
            'user_id',
            'product_id',
            'category_id',
            'total_price'
           ];
}
