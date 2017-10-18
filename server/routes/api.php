<?php

use Illuminate\Http\Request;



Route::group(['middleware' => ['cors','jwt.auth']], function(){

});


Route::group(['middleware' => ['cors']], function(){
	// Logeo y creacion de usuario libres de token
	Route::post('/login', 'AuthController@userAuth');
	Route::post('/v1/users', 'UserAPIController@store');

	//Estamos en desarrollo por lo que todas las rutas se dejan libre de token


	Route::resource('v1/userTypes', 'UserTypeAPIController');

	Route::resource('v1/locals', 'LocalAPIController');

	Route::resource('v1/cities', 'CityAPIController');

	Route::resource('v1/inventaryTypes', 'InventaryTypeAPIController');

	Route::resource('v1/inventaries', 'InventaryAPIController');

	Route::resource('v1/requestBuys', 'RequestBuyAPIController');

	Route::resource('v1/requestBuyDetails', 'RequestBuyDetailAPIController');

	Route::resource('v1/providers', 'ProviderAPIController');

	Route::resource('v1/products', 'ProductAPIController');

	Route::resource('v1/sales', 'SaleAPIController');

	Route::resource('v1/users', 'UserAPIController');

	Route::resource('v1/productTypes', 'ProductTypeAPIController');

	Route::resource('v1/pics', 'PicAPIController');

	Route::resource('v1/productsSales', 'ProductsSaleAPIController');


});





