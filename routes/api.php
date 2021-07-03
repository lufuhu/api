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

Route::get('test', 'IndexController@test')->name('index.test');

Route::post('upload', 'IndexController@upload')->name('index.upload');

Route::prefix('v1')->name('api.v1.')->group(function () {

    Route::prefix('auth')->group(function () {
        Route::get('qrcode_token', 'AuthController@qrcodeToken')->name('auth.qrcodeToken');
        Route::post('qrcode_verify', 'AuthController@qrcodeVerify')->name('auth.qrcodeVerify');
        Route::post('wx_login', 'AuthController@wxLogin')->name('auth.wxLogin');
    });
    Route::prefix('auth')->middleware('auth:sanctum')->group(function () {
        Route::post('qrcode_login', 'AuthController@qrcodeLogin')->name('auth.qrcodeLogin');
        Route::post('loginout', 'AuthController@loginOut')->name('auth.loginOut');
    });

    //博客
    Route::prefix('home')->namespace('Home')->group(function () {
        Route::get('index', 'IndexController@index')->name('index.index');

        Route::prefix('article')->group(function () {
            Route::get('get_select_data', 'ArticleController@getSelectData')->name('article.getSelectData');
            Route::get('get_enum', 'ArticleController@enum')->name('article_md.enum');
            Route::get('article', 'ArticleController@index')->name('article.index');
            Route::get('article/{id}', 'ArticleController@view')->name('article.view');
            Route::post('article', 'ArticleController@store')->name('article.store');
            Route::post('article/{id}', 'ArticleController@update')->name('article.update');
            Route::delete('article/{id}', 'ArticleController@destroy')->name('article.destroy');
        });

    });

    //速查表
    Route::prefix('cheatsheet')->namespace('CheatSheet')->group(function () {
        Route::get('cheatsheet', 'CheatSheetController@index')->name('cheatsheet.index');
        Route::post('cheatsheet', 'CheatSheetController@store')->name('cheatsheet.store');
        Route::post('cheatsheet/{id}', 'CheatSheetController@update')->name('cheatsheet.update');
        Route::post('build/{id}', 'CheatSheetController@build')->name('cheatsheet.build');
        Route::delete('cheatsheet/{id}', 'CheatSheetController@destroy')->name('cheatsheet.destroy');

        Route::get('cheatsheet_md/{pid}', 'CheatSheetMdController@index')->name('cheatsheet_md.index');
        Route::get('cheatsheet_md/{pid}/{id}', 'CheatSheetMdController@view')->name('cheatsheet_md.view');
        Route::post('cheatsheet_md', 'CheatSheetMdController@store')->name('cheatsheet_md.store');
        Route::post('cheatsheet_md/{id}', 'CheatSheetMdController@update')->name('cheatsheet_md.update');
        Route::delete('cheatsheet_md/{id}', 'CheatSheetMdController@destroy')->name('cheatsheet_md.destroy');
    });

    //在线工具
    Route::prefix('tool')->namespace('Tool')->group(function () {
        Route::get('tool', 'ToolController@index')->name('tool.index');
    });

    //面试题
    Route::prefix('interview')->namespace('Interview')->group(function () {
        Route::get('get_select_data', 'InterviewController@getSelectData')->name('interview.getSelectData');
        Route::get('interview', 'InterviewController@index')->name('interview.index');
        Route::get('interview/{id}', 'InterviewController@view')->name('interview.view');
        Route::post('interview', 'InterviewController@store')->name('interview.store');
        Route::post('interview/{id}', 'InterviewController@update')->name('interview.update');
        Route::delete('interview/{id}', 'InterviewController@destroy')->name('interview.destroy');
    });


    Route::prefix('article')->namespace('Article')->group(function () {
        Route::get('article_md_enum', 'ArticleMdController@enum')->name('article_md.enum');
        Route::get('article_md', 'ArticleMdController@index')->name('article_md.index');
        Route::get('article_md/{id}', 'ArticleMdController@view')->name('article_md.view');
        Route::post('article_md', 'ArticleMdController@store')->name('article_md.store');
        Route::post('article_md/{id}', 'ArticleMdController@update')->name('article_md.update');
        Route::delete('article_md/{id}', 'ArticleMdController@destroy')->name('article_md.destroy');
        Route::post('article_md_build/{id}', 'ArticleMdController@build')->name('article_md.build');
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

