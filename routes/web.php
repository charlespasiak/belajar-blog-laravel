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

Auth::routes(); // harus diletakkan paling atas

Route::get('/', 'BlogController@index');
// Route::get('/isi_post', function() {
//     return view('content.isi_post');
// });
Route::get('/isi-post/{slug}', 'BlogController@isi_blog')->name('blog.isi');

// membungkus banyak route dengan route::group([]) supaya dicek apakah sudah login / belum
Route::group(['middleware' => 'auth'], function () {
    Route::get('/home', 'HomeController@index')->name('home');
    Route::resource('category', 'CategoryController');
    Route::resource('tags', 'TagController');
    Route::get('post/trash', 'PostController@showTrash')->name('post.trash'); // route get post harus berada di atas resource post 
    Route::get('post/restore/{post}', 'PostController@restore')->name('post.restore');
    Route::delete('post/kill/{post}', 'PostController@kill')->name('post.kill');
    Route::resource('post', 'PostController');
    Route::resource('user', 'UserController');
});








