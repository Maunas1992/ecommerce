<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Front\ProductFrontController;
use App\Http\Controllers\ProductController;
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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::group(['prefix' => 'admin'], function ($request) {
	
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Auth::routes();
});
Route::get('logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');
Auth::routes();

Route::get('/login', [App\Http\Controllers\Controller::class, 'frontLoginPage'])->name('login');

Route::post('get-states-by-country',[App\Http\Controllers\UserController::class, 'getState'])->name('getState');
Route::post('get-cities-by-state',[App\Http\Controllers\UserController::class, 'getCity'])->name('getCity');

Route::group(['middleware' => ['auth','roles'], 'prefix' => 'admin'], function ($request) {

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/user/index', [App\Http\Controllers\UserController::class, 'index'])->name('user.index');

Route::get('/user/create', [App\Http\Controllers\UserController::class, 'create'])->name('user.create');

Route::post('/user/store', [App\Http\Controllers\UserController::class, 'store'])->name('user.store');

Route::get('/user/edit/{id}', [App\Http\Controllers\UserController::class, 'edit'])->name('user.edit');

Route::post('/user/update/{id}', [App\Http\Controllers\UserController::class, 'update'])->name('user.update');

Route::get('/user/show/{id}', [App\Http\Controllers\UserController::class, 'show'])->name('user.show');

Route::post('/user/destroy/{id}', [App\Http\Controllers\UserController::class, 'destroy'])->name('user.destroy');

Route::resource('product', ProductController::class);
Route::any('/product/create', [App\Http\Controllers\ProductController::class, 'create'])->name('product.create');

Route::any('/product/edit/{id}', [App\Http\Controllers\ProductController::class, 'edit'])->name('product.edit');

Route::get('/category/index', [App\Http\Controllers\CategoryController::class, 'index'])->name('category.index');

Route::get('/category/create', [App\Http\Controllers\CategoryController::class, 'create'])->name('category.create');

Route::post('/category/store', [App\Http\Controllers\CategoryController::class, 'store'])->name('category.store');

Route::get('/category/edit/{id}', [App\Http\Controllers\CategoryController::class, 'edit'])->name('category.edit');

Route::post('/category/update/{id}', [App\Http\Controllers\CategoryController::class, 'update'])->name('category.update');

Route::post('/category/destroy/{id}', [App\Http\Controllers\CategoryController::class, 'destroy'])->name('category.destroy');

Route::get('adminprofile', [App\Http\Controllers\ProfileController::class, 'adminprofile'])->name('adminprofile');

Route::post('adminUpdateProfile/{id}', [App\Http\Controllers\ProfileController::class, 'adminUpdateProfile'])->name('adminUpdateProfile');

Route::get('adminChangePassword', [App\Http\Controllers\ProfileController::class, 'adminChangePassword'])->name('adminChangePassword');

Route::post('adminUpdatePassword/{id}', [App\Http\Controllers\ProfileController::class, 'adminUpdatePassword'])->name('adminUpdatePassword');

Route::get('feedbackList', [App\Http\Controllers\FeedbackController::class, 'feedbackList'])->name('feedbackList');

Route::get('showFeedback/{id}', [App\Http\Controllers\FeedbackController::class, 'showFeedback'])->name('showFeedback');

Route::post('/feedback/destroy/{id}', [App\Http\Controllers\FeedbackController::class, 'destroy'])->name('feedback.destroy');
});
Route::get('/signup', [Controller::class, 'signup'])->name('signup');

Route::get('/', [App\Http\Controllers\Front\ProductFrontController::class, 'index']);

Route::get('/profile', [Controller::class, 'viewprofile'])->name('viewprofile');
Route::post('/updateprofile/{id}', [Controller::class, 'updateprofile'])->name('updateprofile');
Route::get('/change-password', [Controller::class, 'changePassword'])->name('change-password');

Route::post('/change-password', [Controller::class, 'updatePassword'])->name('update-password');
Route::get('/order', [ProductFrontController::class, 'order'])->name('setorder');
Route::get('/index', [ProductFrontController::class, 'index'])->name('getproduct');
Route::get('/show/{id}', [ProductFrontController::class, 'showproduct'])->name('showproduct');
Route::get('/store', [ProductFrontController::class, 'storeproduct'])->name('storeproduct');
Route::get('/getcategory', [ProductFrontController::class, 'getcategory'])->name('getcategory');
Route::get('/favourite', [ProductFrontController::class, 'myfavourite'])->name('myfavourite');
// Route::post('/addfavourite', [ProductFrontController::class, 'addfavourite'])->name('addfavourite');
// Route::get('/addwishlist/{id}', [ProductFrontController::class, 'addwishlist'])->name('addwishlist');

Route::post('/addwishlist/{id}', [ProductFrontController::class, 'addwishlist'])->name('addwishlist');
Route::get('/addwishlist/{id}', [ProductFrontController::class, 'addwishlist'])->name('addwishlist');
Route::post('/removewishlist/{id}', [ProductFrontController::class, 'removewishlist'])->name('removewishlist');
// Route::get('/topics/{category}/{forum}', [
//     'as'   => 'topics.show',
//     'uses' => 'TopicsController@show'
// ]);

