<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
     use  HasFactory;

    protected $fillable = [
            'category_name',
<<<<<<< HEAD
           ];
=======
            'status',
    ];
>>>>>>> 85fafb267049b2bed5d046109a66b228c16b0717

    public function products()
    {
        return $this->hasMany(Product::class,'id','category_id');
    }
}
