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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
/*
Route::group([
        'middleware' => 'api',
        'namespace' => 'App\Http\Controllers',
        'prefix' => 'auth'
    ], function ($router) {
    
        Route::post('login', 'AuthController@login');
        Route::post('logout', 'AuthController@logout');
        Route::post('refresh', 'AuthController@refresh');
        Route::post('me', 'AuthController@me');
    
    });
    */

Route::group(['middleware' => ['sessions'], 'prefix' => 'v1'], function () {

Route::post('load_houses', 'HouseController@load_houses');
Route::post('filter_houses', 'API\HouseController@filter');

Route::get('houses', 'API\HouseController@houses');

Route::get('houses/{page}', 'API\HouseController@houses');

Route::get('index', 'API\HomeController@index');

Route::get('/house/{id}', 'API\HouseController@house');

Route::get('/house_types', 'API\ResourceController@house_types');

Route::get('/locations', 'API\ResourceController@locations');

Route::get('/price_ranges', 'API\ResourceController@price_ranges');

Route::post('/search_realtor', 'API\RealtorController@search');


// Realtor Routes
Route::get('realtor/login', ['middleware' => 'guest', function() {
    return response()->json([], 200);
}]);
Route::post('realtor/login', 'API\Realtor\LoginController@login');
Route::get('realtor/logout', 'API\Realtor\LoginController@logout');

Route::get('realtor/register', 'API\Realtor\RegisterController@individual');
Route::get('realtor/register/company', 'API\Realtor\RegisterController@company');
Route::post('realtor/reg', 'API\Realtor\RegisterController@register');
Route::post('realtor/register/company', 'API\Realtor\RegisterController@register_company');

Route::get('realtor', 'API\Realtor\HomeController@index');
Route::get('realtor/home', 'API\Realtor\HomeController@index');
Route::post('realtor/search_realtor', 'API\Realtor\HomeController@search_realtors');
Route::get('realtor/requests', 'API\Realtor\HomeController@requests');

Route::get('realtor/messages', 'API\Realtor\MessageController@messages');

Route::post('process_circle_request', 'API\Realtor\CircleController@process_request');
Route::get('realtor/mycircle', 'API\Realtor\CircleController@show');
Route::post('realtor/delete_circle', 'API\Realtor\CircleController@delete');

Route::get('realtor/houses', 'API\Realtor\HouseController@houses');
Route::get('realtor/house/{id}', 'API\Realtor\HouseController@show');
Route::get('realtor/add_house', 'API\Realtor\HouseController@add');
Route::get('realtor/edit_house/{id}', 'API\Realtor\HouseController@edit');
Route::patch('realtor/edit_house', 'API\Realtor\HouseController@update');
Route::post('realtor/add_house', 'API\Realtor\HouseController@save');
Route::get('realtor/delete_house/{id}', 'API\Realtor\HouseController@delete');
Route::get('realtor/share_house/{id}', 'API\Realtor\HouseController@share');
Route::post('realtor/share_house', 'API\Realtor\HouseController@share_house');
Route::post('realtor/process_share_request', 'API\Realtor\HouseController@process_share_request');

Route::post('realtor/add_house_photo', 'API\Realtor\PhotoController@save_house_photo');
Route::post('realtor/edit_house_photo', 'API\Realtor\PhotoController@update_house_photo');
Route::post('realtor/delete_photo', 'API\Realtor\PhotoController@delete_house_photo');

Route::get('realtor/estates', 'API\Realtor\EstateController@estates');
Route::get('realtor/add_estate', 'API\Realtor\EstateController@add');
Route::post('realtor/add_estate', 'API\Realtor\EstateController@save');
Route::get('realtor/estate/{id}', 'API\Realtor\EstateController@show');
Route::get('realtor/add_estate_house/{id}', 'API\Realtor\EstateController@add_house');
Route::post('realtor/add_estate_house', 'API\Realtor\EstateController@save_house');

Route::get('/{profile_name}', 'API\RealtorController@realtor');
});
