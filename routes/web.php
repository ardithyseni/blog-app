<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;
use App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

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

Route::get('/', [
    'uses' => 'App\Http\Controllers\BlogController@index',
    'as'   => 'blog'    
]);

// Route::get('/', 'App\Http\Controllers\BlogController@index');


// Route::get(
//     '/',
//     [BlogController::class, 'index']
// );

// Route::get('/', 'App\Http\Controllers\BlogController@index');

// Route::get('/', function () {
//     return view('blog/index');
// });

Route::get('/blog/{post}', [
    'uses' => 'App\Http\Controllers\BlogController@show',
    'as'   => 'blog.show'
]);

Route::get('/category/{category}', [
    'uses' => 'App\Http\Controllers\BlogController@category',
    'as'   => 'category'
]);

Route::get('/author/{author}', [
    'uses' => 'App\Http\Controllers\BlogController@author',
    'as'   => 'author'
]);

Auth::routes(['register' => false]);

Route::get('/home', [App\Http\Controllers\Backend\HomeController::class, 'index'])->name('home');

Route::resource('/backend/blog', 'App\Http\Controllers\Backend\BackendBlogController');