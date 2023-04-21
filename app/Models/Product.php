<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
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
<<<<<<< HEAD
        ];
    public function category()
    {
        return $this->belongsTo(Category::class,'category_id','id');
=======
            'status',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
>>>>>>> 85fafb267049b2bed5d046109a66b228c16b0717
    }
}
