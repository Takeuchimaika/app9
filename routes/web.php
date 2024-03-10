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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('show/{id}', 'App\Http\Controllers\ProductController@show')->name('product.show');

Route::get('search', 'App\Http\Controllers\ProductController@search')->name('search');
//Route::get('show', 'App\Http\Controllers\ProductController@show')->name('product.show');



//削除
Route::delete('/products/{product}', 'App\Http\Controllers\ProductController@destroy')->name('product.destroy');
//削除
//Route::post('/products/{product}', 'App\Http\Controllers\ProductController@destroy')->name('product.destroy');

//一覧画面
Route::get('/products', 'App\Http\Controllers\ProductController@index')->name('product.index');
//検索
//Route::get('/products/search', 'App\Http\Controllers\ProductController@search')->name('search');
//新規登録
Route::get('/products/rebist', 'App\Http\Controllers\ProductController@rebist')->name('product.rebist');
//登録処理
Route::post('/products/store/', 'App\Http\Controllers\ProductController@store')->name('product.store');
//変更をするため
Route::get('/products/edit/{product}', 'App\Http\Controllers\ProductController@edit')->name('product.edit');
//アクセスがあった場合の更新
Route::put('/products/edit/{product}', 'App\Http\Controllers\ProductController@update')->name('product.update');
//詳細を見れる
//Route::get('/products/show/{product}', 'App\Http\Controllers\ProductController@show')->name('product.show');

//詳細を見れる
Route::get('/products/detail/{product}', 'App\Http\Controllers\ProductController@detail')->name('product.detail');



Route::get('/products/create', 'App\Http\Controllers\ProductController@create')->name('product.create');
