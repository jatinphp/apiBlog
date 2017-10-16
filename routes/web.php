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


Route::get('/', 'PostsController@index')->name('home');
Route::get('/posts/create', 'PostsController@create');
Route::get('/register', 'RegistrationController@create');
Route::get('/login', 'SessionsController@create');
Route::get('/logout', 'SessionsController@destroy');
Route::get('/posts/tags/{tag}', 'TagsController@index');
Route::get('/posts/edit/{post}', 'PostsController@edit');
Route::post('/posts/{id}/edit', 'PostsController@update');
Route::post('/login', 'SessionsController@store');
Route::post('/register', 'RegistrationController@store');
Route::post('/posts', 'PostsController@store');
Route::post('/posts/{post}/comments', 'CommentsController@store');
Route::get('/tasks', 'TasksController@index');

Route::get('/posts/{post}', 'PostsController@show');
Route::get('/tasks/{task}', 'TasksController@show');
