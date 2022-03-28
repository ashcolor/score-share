<?php

use App\Http\Controllers\ScoreController;
use App\Http\Controllers\WantController;
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

Route::prefix('v1')->group(function () {
    Route::get('user/self', function (Request $request) {
        return Auth::user();
    });
    Route::get('logout', function (Request $request) {
        Auth::logout();
    });
    Route::resources([
        'scores' => ScoreController::class,
        'wants' => WantController::class,
    ]);
});

//ログインが必要なAPI
Route::middleware('auth:sanctum')->group(function(){
    //
});
