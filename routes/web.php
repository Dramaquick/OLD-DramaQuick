<?php

use App\Http\Controllers\LinkController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\UsernameController;
use App\Http\Controllers\ChangeEmailController;
use App\Http\Controllers\AvatarController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\AnswerController;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;


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


Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

require __DIR__ . '/auth.php';

// ----------------- Auth -----------------

Route::get('/login', function () {
    return Inertia::render('Auth/Login');
})->name('login');

Route::get('/register', function () {
    return Inertia::render('Auth/Register');
})->name('register');

// ----------------- Quiz -----------------

// Access quiz
Route::get('/quiz/{session}', [SessionController::class, 'show'])
->middleware(['auth', 'verified'])->where('session', '[0-9]+')->name('session.show');

// Create quiz
Route::post('/quiz/store', [SessionController::class, 'store'])
->middleware(['auth', 'verified'])->name('session.store');

// Create quiz page
Route::get('/quiz/create', function () {
    return Inertia::render('Session/Session-create');
})->middleware(['auth', 'verified'])->name('session.create');

// Access final page of quiz
Route::get('/quiz/{session}/end', [SessionController::class, 'end'])
->middleware(['auth', 'verified'])->where('session', '[0-9]+')->name('session.end');

// ----------------- Question -----------------

// Access question

Route::get('/question/{session}/{question}', [QuestionController::class, 'show'])
->middleware(['auth', 'verified'])->name('question.show');

// ----------------- User -----------------

// Change username
Route::put('/user/username', [UsernameController::class, 'update'])
->middleware(['auth', 'verified'])->name('user.username.update');

// Change email
Route::put('/user/email', [ChangeEmailController::class, 'update'])
->middleware(['auth', 'verified'])->name('user.email.update');

// Change avatar
Route::post('/user/avatar', [AvatarController::class, 'store'])
->middleware(['auth', 'verified'])->name('user.avatar.update');

// Profile
Route::get('/profile', function () {
    return Inertia::render('Profile');
})->middleware(['auth', 'verified'])->name('profile');

Route::get('/nextquestion/{session}', [SessionController::class, 'nextQuestion'])
->middleware(['auth', 'verified'])->name('session.nextQuestion');

Route::get('/answer/{session}/{question}', [QuestionController::class, 'show'])
->middleware(['auth', 'verified'])->name('answer.show');

Route::get('/leave', [SessionController::class, 'leave'])
->middleware(['auth', 'verified'])->name('session.leave');

Route::get('/session/reset', [SessionController::class, 'reset'])
->middleware(['auth', 'verified'])->name('session.reset');

Route::get('/user/getsession', [SessionController::class, 'getUserSession'])
->middleware(['auth', 'verified'])->name('user.getsession');
// ----------------- Other -----------------

Route::get('/fire-event', function () {
    event(new \App\Events\TestEvent());
    return 'Event has been sent!';
});

Route::get('/session-text', function () {
    return Inertia::render('Session/Session-text');
});

Route::get('/session-select', function () {
    return Inertia::render('Session/Session-select');
});

Route::get('/session-paint', function () {
    return Inertia::render('Session/Session-paint');
});

Route::get('/session-checkbox', function () {
    return Inertia::render('Session/Session-checkbox');
});

Route::get('/session-lowtext', function () {
    return Inertia::render('Session/Session-lowtext');
});

Route::get('/session-radiobutton', function () {
    return Inertia::render('Session/Session-radiobutton');
});

Route::get('/session-slider', function () {
    return Inertia::render('Session/Session-slider');
});

Route::get('/session-finish', function () {
    return Inertia::render('Session/Session-finish');
});

Route::get('/session-answer-text', function () {
    return Inertia::render('Session/Session-answer-text');
});

Route::get('/session-answer-pie', function () {
    return Inertia::render('Session/Session-answer-PieChart');
});

Route::get('/session-answer-bar', function () {
    return Inertia::render('Session/Session-answer-BarChart');
});

