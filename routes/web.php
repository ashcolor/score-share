<?php

use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;

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

//Twitter OAuth
Route::get('/twitter/redirect', function () {
    return Socialite::driver('twitter')->redirect();
});
Route::get('/twitter/callback', [App\Http\Controllers\Auth\TwitterController::class, 'callback'])->name('twitter_callback');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('{any}', function () {
    return view('index');
})->where('any', '.*');


