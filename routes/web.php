<?php

use App\Http\Controllers\LinkController;
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

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/about', function () {
    return Inertia::render('About');
})->middleware(['auth', 'verified'])->name('about');

Route::get('/components', function () {
    return Inertia::render('Components');
});

Route::get('/session-start', function () {
    return Inertia::render('Session/Session-start');
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

Route::get('/session-create', function () {
    return Inertia::render('Session/Session-create');
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

Route::get('/profile', function () {
    return Inertia::render('Profile');
})->middleware(['auth', 'verified'])->name('profile');


// Links
Route::get('/links', [LinkController::class, 'index'])->middleware(['auth', 'verified'])->name('links.index');
Route::post('/links', [LinkController::class, 'store'])->name('links.store');
Route::delete('/links/{link}', [LinkController::class, 'destroy'])->name('links.destroy');
