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

use Illuminate\Support\Facades\Input;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/api/token', 'TokenController@show');

/*
function () {

    $email = Input::get('email');
    $password = Input::get('password');
    if (Auth::attempt(['email' => $email, 'password' => $password])) {
        // Authentication passed...
        $user = Auth::user();
        return [
            'user' => $user->name,
            'api_token' => $user->api_token
        ];
    } else {
        return
    }
});
*/