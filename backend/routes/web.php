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

Route::get('sample/route', function () {
    return 'PHP Framework Laravel Routing!!';
});


Route::get('users', function()
{
    return View::make('users');
});

Route::resource('/post', 'App\Http\Controllers\PostController');

// このページにアクセスする際は登録したメールアドレス・パスワードが必要になります
Route::resource('/post', 'PostController')->middleware('auth');