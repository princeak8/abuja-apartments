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
Route::get('/', 'HomeController@index');
Route::get('/index', 'HomeController@index');
Route::post('/load_houses', 'HouseController@load_houses');
Route::post('/filter_houses', 'HouseController@filter');
Route::post('/filter_houses2', 'HouseController@filter2');
Route::get('/{profile_name}', 'RealtorController@realtor');
Route::get('/house/{id}', 'HouseController@house');

Route::post('send_message', 'MessageController@send');
Route::post('follow', 'RealtorController@follow');
Route::post('unfollow', 'RealtorController@unfollow');
Route::get('/test', function(){
    return view('test');
});

//Realtor Routes Starts Here

Route::get('realtor/login', ['middleware' => 'guest', function() {
    return view('realtor/login');
}]);

Route::post('realtor/login', 'Realtor\LoginController@login');

Route::get('realtor/logout', 'Realtor\LoginController@logout');

Route::get('realtor/register', function() {
	return view('realtor/register');
});

Route::post('realtor/register', 'Realtor\RegisterController@create');

Route::get('realtor/home', 'Realtor\HomeController@index');

Route::post('realtor/search_realtor', 'Realtor\HomeController@search_realtors');

Route::post('process_circle_request', 'CircleController@process_request');

Route::get('realtor/houses', 'Realtor\HouseController@houses');

Route::get('realtor/house/{id}', 'Realtor\HouseController@show');

Route::get('realtor/add_house', 'Realtor\HouseController@add');
Route::get('realtor/edit_house/{id}', 'Realtor\HouseController@edit');
Route::patch('realtor/edit_house', 'Realtor\HouseController@update');
Route::post('realtor/add_house', 'Realtor\HouseController@save');
Route::get('realtor/delete_house/{id}', 'Realtor\HouseController@delete');
Route::post('realtor/add_house_photo', 'Realtor\PhotoController@save_house_photo');
Route::post('realtor/edit_house_photo', 'Realtor\PhotoController@update_house_photo');

Route::post('realtor/delete_photo', 'Realtor\PhotoController@delete_house_photo');

Route::get('realtor/estates', 'Realtor\EstateController@estates');
Route::get('realtor/add_estate', 'Realtor\EstateController@add');
Route::post('realtor/add_estate', 'Realtor\EstateController@save');
Route::get('realtor/estate/{id}', 'Realtor\EstateController@show');
Route::get('realtor/add_estate_house/{id}', 'Realtor\EstateController@add_house');
Route::post('realtor/add_estate_house', 'Realtor\EstateController@save_house');

Route::get('realtor/share_house/{id}', 'Realtor\HouseController@share');
Route::post('realtor/share_house', 'Realtor\HouseController@share_house');
Route::post('realtor/process_share_request', 'Realtor\HouseController@process_share_request');

Route::post('realtor/change_house_mainPhoto', 'Realtor\PhotoController@change_house_main_photo');
Route::post('realtor/change_house_availability', 'Realtor\HouseController@change_house_availability');

Route::get('realtor/requests', 'Realtor\HomeController@requests');

//Realtor routes ends here


