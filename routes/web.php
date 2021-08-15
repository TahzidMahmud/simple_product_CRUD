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

Route::get('/','ProductController@index')->name('home');

Route::resource('products','ProductController' )->except([
    'index'
]);;
Route::resource('colors','ColorController' )->except([
    'create'
]);
Route::resource('product_variants','ProductVariantController' )->except([
    'create','index'
]);
Route::resource('sizes','SizeController' )->except([
    'create'
]);
Route::resource('categories','CategoryController' )->except([
    'create'
]);
Route::resource('subcategories','SubCategoryController' )->except([
    'index','create'
]);
Route::get('/fetchsubcat/{id}','SubCategoryController@fetch_subcats');
Route::get('/products/{product}/variants/edit','ProductVariantController@edit_variants')->name('product.variants.edit');
Route::get('/products/{product}/variants/create','ProductVariantController@create')->name('product.variants.create');
Route::get('/products/{product}/variants','ProductVariantController@fetch_variants')->name('product.variants');
