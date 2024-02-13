<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WebsiteController;
use App\Http\Controllers\BackendController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::controller(WebsiteController::class)->group(function(){
    Route::get('/home/new/onlyfordata/thisroute', 'layout')->name('layout');
    Route::get('/home/{search?}', 'index')->name('home');
    Route::get('/readmore/posts/{post?}', 'post')->name('post')->middleware('postProtected');
    Route::get('/catgorys/{category?}', 'category')->name('web-category');
});

Route::controller(BackendController::class)->group(function(){
    Route::get('/admin/ProjectName/home/{search?}','index')->name('admin');
    Route::post('/admin/ProjectName/data','data')->name('data');
    Route::get('/admin/ProjectName/category','category')->name('category');
    Route::get('/admin/ProjectName/category/delete/{delete?}','categoryDelete')->name('delete');
    Route::post('/admin/ProjectName/newcategory','Addcategory')->name('addcategory');
    Route::get('/admin/ProjectName/post/delete/{id}','deletePost')->name('deletePost');
    Route::get('/admin/ProjectName/post/update/{id}','updatePost')->name('updatePost');
    Route::post('/admin/ProjectName/post/updatenow/{id}','updateNow')->name('updateNow');
});

Route::fallback(function(){
    return view('errors.404');
});











