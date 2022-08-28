<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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
   return view('auth.login');
});




Auth::routes();
Route::get('/admin/login', function () {
    return view('auth.login');
});

Route::get('/admin/login', [App\Http\Controllers\Auth\LoginController::class, 'login']);
Route::get('/admin/adminlogout', [App\Http\Controllers\HomeController::class, 'adminlogout']);
Route::post('/admin/userlogin', [App\Http\Controllers\Auth\LoginController::class, 'userlogin']);
// Route::redirect('/home', '/admin/login');

Route::group(['middleware' =>['admin']], function()
{
  Route::prefix('admin')->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('Dashboards');
    // product-categories
    Route::get('/product-categories', [App\Http\Controllers\Product\CategoryController::class, 'productcategories']);
    Route::get('/product-category/{id?}', [App\Http\Controllers\Product\CategoryController::class, 'productcategory']);
    Route::post('/saveproduct-category', [App\Http\Controllers\Product\CategoryController::class, 'saveproductcategory']);
    Route::get('/deleteproduct-category/{id}', [App\Http\Controllers\Product\CategoryController::class, 'deleteproductcategory']);

    //Products
    Route::get('/products', [App\Http\Controllers\Product\ProductController::class, 'products']);
    Route::get('/product/{id?}', [App\Http\Controllers\Product\ProductController::class, 'product']);
  
    Route::post('/saveproduct', [App\Http\Controllers\Product\ProductController::class, 'saveproduct']);
    Route::get('/deleteproduct/{id}', [App\Http\Controllers\Product\ProductController::class, 'deleteproduct']);
    Route::post('/upload_file', [App\Http\Controllers\Product\ProductController::class, 'upload_file']);
    Route::post('/deletefiles', [App\Http\Controllers\Product\ProductController::class, 'deletefiles']);

});

});
