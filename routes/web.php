<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('/signup', [Controller::class, 'signup'])->name('signup');
Route::get('/store', [Controller::class, 'storeproduct'])->name('storeproduct');
Route::get('/show', [Controller::class, 'showproduct'])->name('showproduct');