<?php
use App\Models\Category;
use App\Models\Product;

if (!function_exists('category')) {
function category()
{
$category = Category::all();
// dd($setting);
if (isset($category)) {
return $category;
} else {
return false;
}
}
}

if (!function_exists('product')) {
function product()
{
$product = Product::all();
// dd($setting);
if (isset($product)) {
return $product;
} else {
return false;
}
}
}
