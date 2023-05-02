<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TagController;
use App\Http\Controllers\UsernameController;
use App\Http\Controllers\AvatarController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\AnswerController;

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

// ----------------- Session -----------------

// Get a tag
Route::get('/tag/{tag}', [TagController::class, 'show'])
->middleware('throttle:120,1')
->name('tag.show');

// Get all tags
Route::get('/tags', [TagController::class, 'showAll'])
->middleware('throttle:120,1')
->name('tag.showAll');

// Get tags of a session
Route::get('/session/tags/{session}', [TagController::class, 'showForSession'])
->middleware('throttle:120,1')
->name('tag.showForSession');

// ----------------- User --------------------


// Get username
Route::get('/user/username/{user}', [UsernameController::class, 'show'])
->middleware('throttle:120,1')
->name('user.username.show');

// Get avatar
Route::get('/user/avatar/{user}', [AvatarController::class, 'show'])
->middleware('throttle:120,1')
->name('user.avatar.show');

// ----------------- Session -----------------

// Get session exist or not

Route::post('/session/exist/{session}', [SessionController::class, 'sessionExist'])
->name('session.exist');

Route::post('/answer/store/', [AnswerController::class, 'store'])
->name('answer.store');

// Get number sessions finished

Route::get('/sessions/finished', [SessionController::class, 'sessionsFinished'])
->name('session.finished');

// Get number sessions in progress

Route::get('/sessions/inprogress', [SessionController::class, 'sessionsInProgress'])
->name('session.inprogress');

// Get the number of all answers

Route::get('/answers/all', [AnswerController::class, 'allAnswers'])
->name('answer.all');