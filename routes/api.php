<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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


Route::apiResources([
    'roles' => 'API\Rolescontroller',
    'users' => 'API\UsersController'
]);
Route::put('follow/{id}', 'API\UsersController@followUser');
Route::put('unfollow/{id}', 'API\UsersController@unfollowUser');
Route::get('followed/{id}', 'API\UsersController@followedUser');

Route::get('profile','API\UsersController@profile');
Route::put('profile','API\UsersController@updateProfileInfo');



