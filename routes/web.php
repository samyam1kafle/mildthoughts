<?php

use Illuminate\Support\Facades\Route;

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

/*Frontend Routes*/


/*Main Routes For index of frontend and backend*/
Route::get('/', function () {
    return view('welcome');
});

Route::get('admin', 'HomeController@backend')->name('admin')->where('{path}', '([A-z\d\-\/_.]+)?');

Auth::routes();
/*Main Routes For index of frontend and backend*/

/*Browse By Tags Routes*/
Route::get('tags/{id}','FrontendController\ThoughtsController@DataByTags');
/*Browse By Tags Routes*/

/*Profile Routes*/

Route::get('profile/{id}', 'HomeController@profileInfo');

Route::get('Auth_profile', 'HomeController@authProfileInfo');

/*Profile Routes*/

Route::get('/login-signup', 'FrontendController\ThoughtsController@loginSignup')->name('login-signup');

Route::get('/thoughts', 'FrontendController\ThoughtsController@thoughts');

Route::get('/user', 'FrontendController\ThoughtsController@user');

Route::get('/', 'HomeController@index')->name('home');


Route::get('{path}', 'HomeController@index')->where('path', '([A-z\d\-\/_.]+)?');



/*Frontend Routes*/






