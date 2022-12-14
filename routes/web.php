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
    Route::get('mypage/setting', [App\Http\Controllers\HomeController::class, 'mypage_setting']);
    Route::get('mypage', [App\Http\Controllers\HomeController::class, 'mypage'])->name('mypage');
    Route::get('matching', [App\Http\Controllers\SwipeController::class, 'match'])->name('matching');
    Route::get('chat', [App\Http\Controllers\ChatsController::class, 'index'])->name('chat');
    Route::get('messages', [App\Http\Controllers\ChatsController::class, 'fetchMessages']);
    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::post('posts/auth', [App\Http\Controllers\HomeController::class, 'set_status'])->name('mypage.update');
    Route::post('swipes', [App\Http\Controllers\SwipeController::class, 'store'])->name('swipes.store');
    Route::post('noticedall', [App\Http\Controllers\HomeController::class, 'noticed_all'])->name('noticed.all');
    Route::post('noticed', [App\Http\Controllers\HomeController::class, 'noticed'])->name('noticed');
    Route::post('messages', [App\Http\Controllers\ChatsController::class, 'sendMessage']);
    Route::post('gameadd', [App\Http\Controllers\HomeController::class, 'add_game'])->name('admin.gameadd');
    Route::post('gamedelete', [App\Http\Controllers\HomeController::class, 'delete_game'])->name('admin.gamedelete');
});

// アドミン以外見られたくないルート設定
Route::middleware(['AdminMiddleware'])->group(function(){
    Route::get('admin', [App\Http\Controllers\HomeController::class, 'admin'])->name('admin');
});

//Lineログイン時のルーティング
Route::get('/linelogin', [App\Http\Controllers\LineLoginController::class, 'lineLogin'])->name('linelogin');
Route::get('/callback', [App\Http\Controllers\LineLoginController::class, 'callback'])->name('callback');