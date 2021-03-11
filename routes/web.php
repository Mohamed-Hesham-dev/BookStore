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
//Route::post('restore/{id}','sectionController@restore')->name ('restore');
//<form action=" {{route ('restore',$section->id)}}" method="post">in html
Route::resource('library','sectionController');
Route::get('admin','sectionController@admin')->name('admin');
Route::post('restore/{id}','sectionController@restore');
Route::post('delete-forever/{id}','sectionController@deleteForever');
Route::resource('books','booksController');
Route::get('summary','booksController@summary')->name('summary');






Auth::routes();

