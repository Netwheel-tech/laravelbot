<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Telegram\Bot\Api;
use Telegram\Bot\Laravel\Facades\Telegram;
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
$telegram = new Api('2112813094:AAFLMlGU0YKNGGUMbi4uDlTBOkVJ9oqFaT4');

Route::get('/', function () {
    return redirect('/login');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::post($telegram->getAccessToken(), function() {
  app('App\Http\Controllers\Admin\TelegramController')->webhook();
});

Route::get($telegram->getAccessToken(), function() {
    app('App\Http\Controllers\Admin\TelegramController')->webhook();
});


Route::group(['middleware' => ['role:admin']], function () {
    Route::get('/panel', 'App\Http\Controllers\Admin\SettingController@index')->name('result.index');
    Route::post('/panel/store', 'App\Http\Controllers\Admin\SettingController@store')->name('result.store');
    Route::post('/panel/setwebhook', 'App\Http\Controllers\Admin\SettingController@setwebhook')->name('result.setwebhook');
    Route::post('/panel/getwebhookinfo', 'App\Http\Controllers\Admin\SettingController@getwebhookinfo')->name('result.getwebhookinfo');

    Route::get('/list', function () {

        $votedusers = DB::table('telegram_users')->get();

        return view('result.list', ['votedusers' => $votedusers]);
    })->name('list');
});


