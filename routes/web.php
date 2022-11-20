<?php

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

// Route::get('/', function () {
//     return view('welcome');
// })->middleware(['auth.shopify'])->name('home');

Route::group(['prefix' => 'admin', 'middleware' => 'guest:admin'], function() {
    Route::get('login', 'App\Http\Controllers\Auth\LoginController@showAdminLoginForm')->name('login');
    Route::post('login', 'App\Http\Controllers\Auth\LoginController@adminLogin')->name('dologin');
 
   
});

Route::group(['prefix' => 'admin', 'middleware' => 'auth:admin'], function() {
    Route::get('logout','App\Http\Controllers\Auth\LoginController@logout')->name("logout");
    Route::get('/add_badge', 'App\Http\Controllers\BadgeController@create')->name('add_badge');
    Route::get('/view_badge/{id}', 'App\Http\Controllers\BadgeController@view')->name('view_badge');
    Route::delete('/delete_badge', 'App\Http\Controllers\BadgeController@deleteMe')->name('delete_badge');
    Route::post('/save_badge', 'App\Http\Controllers\BadgeController@store')->name('save_badge');
    Route::get('/list_badges', 'App\Http\Controllers\BadgeController@index')->name('badge_list');
    //Sticker
    Route::get('/admin_product_list','App\Http\Controllers\ProductController@home')->name('admin_product_list');


    //Categories
    Route::get('/categories','App\Http\Controllers\CategoryController@allCategories')->name('categories');
    Route::get('/add-categories','App\Http\Controllers\CategoryController@addCategories')->name('add-categories');
    Route::post('/store-categories','App\Http\Controllers\CategoryController@storeCategories')->name('store-categories');
    Route::get('/edit-categories/{id}','App\Http\Controllers\CategoryController@editCategories')->name('edit_categories');
    Route::post('/update-categories','App\Http\Controllers\CategoryController@updateCategories')->name('update-categories');

    Route::get('/customize_product_list','App\Http\Controllers\ProductController@customize_product_list')->name('customize_product_list');
    
    Route::get('/list_sticker','App\Http\Controllers\StickerController@index')->name('list_sticker');
    Route::get('/add_sticker', 'App\Http\Controllers\StickerController@create')->name('add_sticker');
    Route::get('/view_sticker/{id}', 'App\Http\Controllers\StickerController@view')->name('view_sticker');
    Route::delete('/delete_sticker', 'App\Http\Controllers\StickerController@deleteMe')->name('delete_sticker');
    Route::post('/save_sticker', 'App\Http\Controllers\StickerController@store')->name('save_sticker');
    Route::get('/add_product', 'App\Http\Controllers\ProductController@create')->name('add_product');
    Route::get('/view_product/{id}', 'App\Http\Controllers\ProductController@view')->name('view_product');
    Route::delete('/delete_product', 'App\Http\Controllers\ProductController@deleteMe')->name('delete_product');
    Route::post('/save_product', 'App\Http\Controllers\ProductController@store')->name('save_product');
    Route::get('/get_product_image', 'App\Http\Controllers\DesignController@getImage')->name('get_product_image');
    //Shops

    Route::get('/shops','App\Http\Controllers\ShopController@getShop')->name('shops');
});


//Product
Route::get('/','App\Http\Controllers\ProductController@index')->middleware(['auth.shopify'])->name('home');
Route::get('/designer/{id}','App\Http\Controllers\DesignController@index')->middleware(['auth.shopify'])->name('designer');
Route::get('/my_products','App\Http\Controllers\ProductController@myProduct')->middleware(['auth.shopify'])->name('myproducts');
Route::post('/save_customize_product', 'App\Http\Controllers\ProductController@save_customize_product')->middleware(['auth.shopify'])->name('save_customize_product');
