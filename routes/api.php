<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('v1')->name('api.v1.')->group(function () {
    Route::prefix('auth')->group(function () {
        Route::post('login', 'AuthController@login')->name('auth.login');
    });
    Route::middleware('auth:sanctum')->prefix('auth')->group(function () {
        Route::post('loginout', 'AuthController@loginOut')->name('auth.loginOut');
        Route::post('update_userinfo', 'AuthController@updateUserInfo')->name('auth.updateUserInfo');
    });
    Route::prefix('article')->namespace('Article')->group(function () {
        Route::get('article_md_enum', 'ArticleMdController@enum')->name('article_md.enum');
        Route::get('article_md', 'ArticleMdController@index')->name('article_md.index');
        Route::get('article_md/{id}', 'ArticleMdController@view')->name('article_md.view');
        Route::post('article_md', 'ArticleMdController@store')->name('article_md.store');
        Route::post('article_md/{id}', 'ArticleMdController@update')->name('article_md.update');
        Route::delete('article_md/{id}', 'ArticleMdController@destroy')->name('article_md.destroy');
    });
    Route::middleware('auth:sanctum')->prefix('chat')->namespace('Chat')->group(function () {
        Route::get('room', 'ChatRoomController@index')->name('chat_room.index');
        Route::get('room/{id}', 'ChatRoomController@view')->name('chat_room.view');
        Route::post('room', 'ChatRoomController@store')->name('chat_room.store');
        Route::post('room/{id}', 'ChatRoomController@update')->name('chat_room.update');
        Route::delete('room/{id}', 'ChatRoomController@destroy')->name('chat_room.destroy');

        Route::get('message', 'ChatMessageController@index')->name('chat_message.index');
        Route::get('message/{id}', 'ChatMessageController@view')->name('chat_message.view');
        Route::post('message', 'ChatMessageController@store')->name('chat_message.store');
        Route::post('message/{id}', 'ChatMessageController@update')->name('chat_message.update');
        Route::delete('message/{id}', 'ChatMessageController@destroy')->name('chat_message.destroy');
    });
});

