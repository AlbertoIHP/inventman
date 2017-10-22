<?php

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
  return redirect('home');
});


Auth::routes();

Route::get('/home', 'HomeController@index');

Route::resource('users', 'UserController');

Route::resource('userTypes', 'UserTypeController');

Route::resource('locals', 'LocalController');

Route::resource('cities', 'CityController');

Route::resource('invetaries', 'InvetaryController');

Route::resource('products', 'ProductController');

Route::resource('providers', 'ProviderController');

Route::resource('requestDetails', 'RequestDetailController');

Route::resource('requests', 'RequestController');

Route::resource('users', 'UserController');

Route::resource('userTypes', 'UserTypeController');

Route::resource('locals', 'LocalController');

Route::resource('cities', 'CityController');

Route::resource('inventaryTypes', 'InventaryTypeController');

Route::resource('inventaries', 'InventaryController');

Route::resource('requestBuys', 'RequestBuyController');

Route::resource('requestBuyDetails', 'RequestBuyDetailController');

Route::resource('providers', 'ProviderController');

Route::resource('products', 'ProductController');

Route::resource('sales', 'SaleController');

Route::resource('users', 'UserController');

Route::resource('productTypes', 'ProductTypeController');

Route::resource('pics', 'PicController');

Route::resource('products', 'ProductController');

Route::resource('sales', 'SaleController');

Route::resource('productsSales', 'ProductsSaleController');

Route::resource('userTypes', 'UserTypeController');

Route::resource('userTypes', 'UserTypeController');