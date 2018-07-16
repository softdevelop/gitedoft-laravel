<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
// localhost/api/auth/
Route::group([
	'prefix' => 'auth',
	'namespace' => 'API'
], function () {
	Route::post('register', 'AuthController@register');
	Route::post('login', 'AuthController@login');
	Route::get('users', 'AuthController@listUser');

	Route::group([
		'middleware' => 'jwt.auth'
	], function () {
		Route::get('userInfor', 'AuthController@user');
		Route::post('logout', 'AuthController@logout');
	});
});
Route::group([
	'namespace' => 'API'
], function () {
	Route::resource('films', 'FilmController');
	Route::group([
		'middleware' => 'jwt.auth'
	], function () {
		Route::post('comments', 'FilmController@commentFilms');
	});
});