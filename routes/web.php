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

Route::get('/', function () {
    return view('welcome');
});

Route::group(['namespace' => 'Blog', 'prefix' => 'blog'], function (){
   Route::resource('posts', 'PostController')->names('blog.posts');
});

//Route::resource('rest', 'RestTestController')->names('restTest');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/calendar', 'GoogleCalendarController@index')->name('google.calendar');
Route::get('/calendar/createEvent', 'GoogleCalendarController@createEvents')->name('createEvent');


Route::group(['namespace' => 'Blog', 'prefix' => 'blog'], function (){
    Route::resource('posts', 'PostController')->names('blog.posts');
});

// Admin

$groupData = [
  'namespace' => 'Blog\Admin',
  'prefix'    => 'admin/blog',
];
Route::group($groupData, function () {
   // BlogCategory
    $methods = ['index', 'edit', 'update', 'create', 'store'];
    // BlogCategory
    Route::resource('categories', 'CategoryController')
        ->only($methods)
        ->names('blog.admin.categories');

    // BlogPost
    Route::resource('posts', 'PostController')
        ->except(['show'])
        ->names('blog.admin.posts');
});


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
