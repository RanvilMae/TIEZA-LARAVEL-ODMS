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
Route::post('/admin/tagging', 'AdminController@tagging');
Route::post('/admin/uploadprocess', 'AdminController@uploadprocess');
Route::post('/admin/save_tag', 'AdminController@save_tag');
Route::get('/admin/remarks', 'AdminController@remarks');
Route::get('/admin/subfile', 'AdminController@subfile');
Route::post('/admin/save_sub', 'AdminController@save_sub');
Route::get('/admin/addremarks', 'AdminController@addremarks');
Route::get('/admin/post', 'AdminController@post');
Route::get('/admin/viewfile', 'AdminController@viewfile');
Route::post('/admin/save_addremarks', 'AdminController@save_addremarks');
Route::post('/admin/save_remarks', 'AdminController@save_remarks');
Route::get('/admin/download_status', 'AdminController@download_status');
Route::post('/admin/update_file', 'AdminController@update_file');
Route::get('/admin/viewdata', 'AdminController@viewdata');
Route::get('/admin/logout', 'AdminController@logout');
Route::get('/admin/pdf_status', [AdminController::class, 'generatePDF']);
Route::get('/admin/pdf_subfile', [AdminController::class, 'generatePDF_subfile']);
Route::get('/admin/pdfqr', [AdminController::class, 'generateQR'])->name('my-pdfqr');



Route::get('/attendance/sample', 'AdminController@index');