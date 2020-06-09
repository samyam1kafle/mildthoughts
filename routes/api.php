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
    'users' => 'API\UsersController',
    'category' => 'API\ThoughtsCategoryController',
    'thoughts' => 'API\ThoughtsController'
]);

/*Like Unlike /Follow unfollow Routes*/

Route::put('/like_unlike/{id}','API\Frontend\LikesUnlikesController@likeUnlike');
Route::get('/like_unlike_count/{id}','API\Frontend\LikesUnlikesController@likeUnlikeCount');

Route::put('follow/{id}', 'API\UsersController@followUser');
Route::put('unfollow/{id}', 'API\UsersController@unfollowUser');
Route::get('followed/{id}', 'API\UsersController@followedUser');

/*Like Unlike /Follow unfollow Routes*/

Route::get('profile', 'API\UsersController@profile');

Route::put('profile', 'API\UsersController@updateProfileInfo');

Route::middleware('api')->get('markAsRead/{id}', function ($id) {
    $user = \App\User::findOrFail($id);
    $user->unreadNotifications->markAsRead();

    $newRead = $user->Notifications->sortByDesc('created_at')->take(5);


    return response()->json(['notifications' => $newRead], 200);
});





