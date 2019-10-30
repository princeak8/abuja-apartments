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
Route::get('/email', function() {
    return view('email');
});

Route::get('/test_mail', 'TestMailController@index');

Route::get('/', 'HomeController@index');
Route::get('/index', 'HomeController@index');
Route::post('/load_houses', 'HouseController@load_houses');
Route::post('/filter_houses', 'HouseController@filter');
Route::post('/filter_houses2', 'HouseController@filter2');

Route::get('about', 'PageController@about');
Route::get('contact', 'PageController@contact');
Route::post('/send_contact_message', 'PageController@send');

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
}])->name('login');

Route::get('password_recovery/test', 'PasswordRecoveryController@test');
Route::get('forgot_password', ['middleware' => 'guest', function() {
    return view('forgot_password');
}])->name('password_recovery');
Route::post('password_recovery/change_password', 'PasswordRecoveryController@change_password');
Route::post('password_recovery/verify_email', 'PasswordRecoveryController@verify_email');
Route::post('password_recovery/send_recovery_mail', 'PasswordRecoveryController@send_mail');
Route::get('reset_password/{email}/{token}', 'PasswordRecoveryController@reset_password');

Route::get('code', ['middleware' => 'guest', function() {
    echo urlencode('$2y$10$d7RAP2ORpuTa/nt1qaFHbOvx6O/5jRvjBQf.dyw5O1tW0qav0HQcS');
}]);

Route::post('realtor/login', 'Realtor\LoginController@login');

Route::get('realtor/logout', 'Realtor\LoginController@logout');

Route::get('register', 'Realtor\RegisterController@individual');
Route::get('register/company', 'Realtor\RegisterController@company');
Route::post('realtor/reg', 'Realtor\RegisterController@register');
Route::post('realtor/register/company', 'Realtor\RegisterController@register_company');

//Route::post('realtor/register', 'Realtor\RegisterController@create');

Route::get('realtor/send_email', 'Realtor\RegisterController@send_email');

Route::get('/realtor', 'Realtor\HomeController@index');
Route::get('realtor/home', 'Realtor\HomeController@index');

Route::get('realtor/tickets', 'Realtor\TicketController@index');
Route::get('realtor/create_ticket', 'Realtor\TicketController@create_ticket');
Route::post('realtor/add_ticket', 'Realtor\TicketController@save');

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
Route::get('realtor/edit_estate/{id}', 'Realtor\EstateController@edit');
Route::patch('realtor/edit_estate', 'Realtor\EstateController@update');
Route::get('realtor/estate/{id}', 'Realtor\EstateController@show')->name('estate.show');
Route::get('realtor/add_estate_house/{id}', 'Realtor\EstateController@add_house');
Route::post('realtor/add_estate_house', 'Realtor\EstateController@save_house');
Route::post('realtor/add_estate_photo', 'Realtor\PhotoController@save_estate_photo');
Route::post('realtor/edit_estate_photo', 'Realtor\PhotoController@update_estate_photo');
Route::post('realtor/change_estate_mainPhoto', 'Realtor\PhotoController@change_estate_main_photo');
Route::post('realtor/delete_estate_photo', 'Realtor\PhotoController@delete_estate_photo');

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

