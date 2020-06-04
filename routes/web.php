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

Route::get('/', function () {
    return view('welcome');
});

Route::get('dashboard', function () {
    return view('backend/master');
})->name('admin');

Auth::routes();

Route::get('/login-signup', 'FrontendController\ThoughtsController@loginSignup')->name('login-signup');

Route::get('/thoughts', 'FrontendController\ThoughtsController@thoughts');
Route::get('/user', 'FrontendController\ThoughtsController@user');

Route::get('/', 'HomeController@index')->name('home');


Route::get('{path}', 'HomeController@index')->where('path', '([A-z\d\-\/_.]+)?');


