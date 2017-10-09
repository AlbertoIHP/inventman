<?php

use Illuminate\Http\Request;



Route::group(['middleware' => ['cors','jwt.auth']], function(){

});


Route::group(['middleware' => ['cors']], function(){
	// Logeo y creacion de usuario libres de token
	Route::post('/login', 'AuthController@userAuth');
	Route::post('/v1/users', 'UserAPIController@store');

	//Estamos en desarrollo por lo que todas las rutas se dejan libre de token

	Route::resource('v1/users', 'UserAPIController');

	Route::resource('v1/userTypes', 'UserTypeAPIController');

	Route::resource('v1/locals', 'LocalAPIController');

	Route::resource('v1/cities', 'CityAPIController');

	Route::resource('v1/invetaries', 'InvetaryAPIController');

	Route::resource('v1/products', 'ProductAPIController');

	Route::resource('v1/providers', 'ProviderAPIController');

	Route::resource('v1/requestDetails', 'RequestDetailAPIController');

	Route::resource('v1/requests', 'RequestAPIController');	



});


