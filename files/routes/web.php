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

Route::get('/house/{id}', 'HouseController@house');

Route::post('/search_realtor', 'RealtorController@search');

Route::post('send_message', 'Realtor\MessageController@send');
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

Route::get('realtor/register', 'Realtor\RegisterController@individual');
Route::get('realtor/register/company', 'Realtor\RegisterController@company');
Route::post('realtor/reg', 'Realtor\RegisterController@register');
Route::post('realtor/register/company', 'Realtor\RegisterController@register_company');

//Route::post('realtor/register', 'Realtor\RegisterController@create');

Route::get('realtor/send_email', 'Realtor\RegisterController@send_email');

Route::get('/realtor', 'Realtor\HomeController@index');
Route::get('realtor/home', 'Realtor\HomeController@index');

Route::get('realtor/messages', 'Realtor\MessageController@messages');

Route::post('realtor/search_realtor', 'Realtor\HomeController@search_realtors');

Route::post('process_circle_request', 'Realtor\CircleController@process_request');
Route::get('realtor/mycircle', 'Realtor\CircleController@show');
Route::post('realtor/delete_circle', 'Realtor\CircleController@delete');

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

Route::get('realtor/profile', 'Realtor\ProfileController@index');
Route::post('realtor/edit_profile', 'Realtor\ProfileController@edit_field');
Route::get('realtor/change_email', 'Realtor\ProfileController@change_email');
Route::patch('realtor/edit_email', 'Realtor\ProfileController@update_email');
Route::get('realtor/change_password', 'Realtor\ProfileController@change_password');
Route::patch('realtor/edit_password', 'Realtor\ProfileController@update_password');
Route::get('realtor/change_secret_question', 'Realtor\ProfileController@change_secret_question');
Route::patch('realtor/edit_secret_question', 'Realtor\ProfileController@update_secret_question');
Route::get('realtor/change_secret_answer', 'Realtor\ProfileController@change_secret_answer');
Route::patch('realtor/edit_secret_answer', 'Realtor\ProfileController@update_secret_answer');
Route::get('realtor/change_profile_photo', 'Realtor\ProfileController@change_profile_photo');
Route::patch('realtor/edit_profile_photo', 'Realtor\ProfileController@update_profile_photo');
Route::get('realtor/edit_about', 'Realtor\ProfileController@edit_about');
Route::patch('realtor/edit_about', 'Realtor\ProfileController@update_about');


//Realtor routes ends here

Route::get('/{profile_name}', 'RealtorController@realtor');

