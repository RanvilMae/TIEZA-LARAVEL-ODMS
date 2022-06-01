<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;


//INDEX
Route::get('/', 'IndexController@index');
Route::post('/login-process', 'IndexController@login_process');
Route::get('/login-process', 'IndexController@redirect_to_login');


//ADMIN

Route::get('/admin/', 'AdminController@index');
Route::get('/admin/home-admin', 'AdminController@home_admin');
Route::get('/admin/upload', 'AdminController@upload');
Route::get('/admin/tagging', 'AdminController@tagging');
Route::post('/admin/uploadprocess', 'AdminController@uploadprocess');
Route::post('/admin/save_tag', 'AdminController@save_tag');
Route::get('/admin/remarks', 'AdminController@remarks');
Route::get('/admin/addremarks', 'AdminController@addremarks');
Route::get('/admin/post', 'AdminController@post');
Route::post('/admin/save_addremarks', 'AdminController@save_addremarks');
Route::post('/admin/save_remarks', 'AdminController@save_remarks');
Route::post('/admin/generateqr', 'AdminController@generateqr');
Route::get('/admin/pdfqr', 'AdminController@pdfqr');
Route::get('/admin/viewdata', 'AdminController@viewdata');
Route::get('/admin/logout', 'AdminController@logout');

Route::get('/qr-code',[App\Http\Controllers\AdminController::class,'pdfqr'])->name('add-qr-code');

Route::get('/attendance/sample', 'AdminController@index');