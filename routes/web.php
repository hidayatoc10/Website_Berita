<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\WebController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::controller(AuthController::class)->middleware('guest')->name('auth.')->group(function () {
    Route::get('/login', 'login')->name('login');
    Route::post('/login', 'loginProcess')->name('login.process');
    Route::get('/register', 'register')->name('register');
    Route::post('/register', 'registerProcess')->name('register.process');
});

Route::middleware('auth')->group(function () {
    Route::get('/logout', [AuthController::class, 'logout'])->name('auth.logout');

    Route::controller(PostController::class)->prefix('/post')->name('post.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/create', 'store')->name('store');
        Route::get('/{post}/edit', 'edit')->name('edit');
        Route::put('/{post}/edit', 'update')->name('update');
        Route::get('/{post}/delete', 'destroy')->name('destroy');
    });

    Route::controller(AccountController::class)->prefix('/account')->name('account.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/edit', 'edit')->name('edit');
        Route::put('/edit', 'update')->name('update');
    });
});

Route::controller(WebController::class)->name('web.')->group(function () {
    Route::get('/', 'index')->name('index');
    Route::get('/{post:slug}', 'page')->name('page');
});




