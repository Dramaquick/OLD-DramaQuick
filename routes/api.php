<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChangeUsernameController;
use App\Http\Controllers\ChangeEmailController;
use App\Http\Controllers\ChangeAvatarController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::resource('/user/change-username', ChangeUsernameController::class)
    ->middleware('auth')
    ->missing(function (Request $request) {
        return Redirect::route('/change-username.index');
    });;

Route::resource('/user/change-email', ChangeEmailController::class)
    ->middleware('auth')
    ->missing(function (Request $request) {
        return Redirect::route('/user/change-email.index');
    });;

Route::resource('/user/change-avatar', ChangeAvatarController::class)
    ->middleware('auth')
    ->missing(function (Request $request) {
        return Redirect::route('/user/change-avatar.index');
    });;
