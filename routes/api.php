<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChangeUsernameController;
use App\Http\Controllers\ChangeEmailController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\UsernameController;
use App\Http\Controllers\AvatarController;

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

Route::resource('/user/change-avatar', AvatarController::class)
    ->middleware('auth')
    ->missing(function (Request $request) {
        return Redirect::route('/user/change-avatar.index');
    });;

// ----------------- Session -----------------

// Get a tag
Route::get('/tag/{tag}', [TagController::class, 'show'])
->name('tag.show');

// Get all tags
Route::get('/tags', [TagController::class, 'showAll'])
->name('tag.showAll');

// Get tags of a session
Route::get('/session/tags/{session}', [TagController::class, 'showForSession'])
->name('tag.showForSession');

// ----------------- User --------------------


// Get username
Route::get('/user/username/{user}', [UsernameController::class, 'show'])
->name('user.username.show');

// Get avatar
Route::get('/user/avatar/{user}', [AvatarController::class, 'show'])
->name('user.avatar.show');