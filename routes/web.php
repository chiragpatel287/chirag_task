<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;

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






/* user route */
Route::group(['namespace' => 'App\Http\Controllers\Backend'], function ($backendVerified) {

    $backendVerified->get('/login', 'LoginController@login')->name('login');
    $backendVerified->get('/', 'LoginController@login')->name('login');
    $backendVerified->post('/user-login', 'LoginController@userLogin')->name('user-login');

    $backendVerified->get('/sign-up', 'RegisterController@registerUser')->name('sign-up');
    $backendVerified->post('/user-register', 'RegisterController@frontRegister')->name('user-register');
    $backendVerified->post('/check-email', 'RegisterController@checkEmailExistOrNot')->name('check_customer_register_email');
});



Route::middleware(['auth:sanctum', 'verified'])->group(function ($route) {
    $route->group(['namespace' => 'App\Http\Controllers\Backend'], function ($backendVerified) {
        $backendVerified->get('/dashboard', 'LoginController@dashboard')->name('dashboard');

        $backendVerified->get('/get-blogs-ajax-list', 'BlogController@blogsAjaxList')->name('get-blogs-ajax-list');
        $backendVerified->resource('blogs', 'BlogController');

        $backendVerified->any('/logout', 'LoginController@logout')->name('logout');
    });
});



