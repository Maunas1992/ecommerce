<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
            'product_name',
            'description',
            'image',
            'qty',
            'price',
            'colour',
            'category'
}
