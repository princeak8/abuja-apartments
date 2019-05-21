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
Route::post('filter_houses', 'HouseController@filter');

Route::get('houses', 'API\HouseController@houses');

Route::get('index', 'API\HomeController@index');

Route::get('/house/{id}', 'API\HouseController@house');




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

Route::get('realtor/messages', 'Realtor\MessageController@messages');

Route::get('/{profile_name}', 'API\RealtorController@realtor');
});
