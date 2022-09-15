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



Auth::routes();
// ログアウト時のルーティング
Route::get('/top', [App\Http\Controllers\LogoutHomeController::class, 'index']);

// ログイン時のルーティング
Route::group(['middleware' => 'auth'], function(){
    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('mypage/setting', [App\Http\Controllers\HomeController::class, 'mypage_setting']);
    Route::get('mypage', [App\Http\Controllers\HomeController::class, 'mypage'])->name('mypage');
    Route::post('/posts/auth', [App\Http\Controllers\HomeController::class, 'set_status'])->name('mypage.update');
    
});
