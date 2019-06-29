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

Auth::routes();

Route::get('home', 'HomeController@index')->name('home');

Route::resource('bookmarks', 'BookmarksController');

// Route for users
Route::match(['get', 'head'], 'users', 'UsersController@index')->name("users.index");
Route::delete('users/{user}', 'UsersController@destroy')->name('users.destroy');
Route::match(['put', 'patch'], 'users/{user}', 'UsersController@update')->name('users.update');
Route::match(['get', 'head'], 'users/{user}', 'UsersController@show')->name('users.show');
Route::match(['get', 'head'], 'users/{user}/edit', 'UsersController@edit')->name('users.edit');

// Route for assigning and removing tags
Route::match(['get', 'head'], 'tags', 'TagsController@index')->name('tags.index');
Route::match(['get', 'head'], 'tags/{tag}', 'TagsController@show')->name('tags.show');
Route::match(['put', 'patch'], 'tags/{bookmark}', 'TagsController@update')->name('tags.update');
Route::delete('tags/{bookmark}/{tag}', 'TagsController@destroy')->name('tags.destroy');