<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\PersonController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\SocialController;
use App\Http\Controllers\LandingController;


use App\Http\Controllers\Admin\DashboardController;

// Public
Route::view('/', 'welcome');
// Landing page + unique ID search
Route::get('/', [LandingController::class, 'index']);
Route::post('/search-person', [LandingController::class, 'searchPerson'])->name('search.person');

Route::get('/login',      [AuthController::class, 'loginform'])->name('loginform');
Route::post('/login',     [AuthController::class, 'login'])->name('login');
Route::get('/register',   [AuthController::class, 'registerform'])->name('registerform');
Route::post('/register',  [AuthController::class, 'register'])->name('register');
Route::post('/logout',    [AuthController::class, 'logout'])->name('logout');
Route::view('/error',     'auth.errors.error403')->name('auth.error403');

// Social
Route::get('login/google',   [SocialController::class, 'redirectToGoogle'])->name('google.login');
Route::get('login/google/callback', [SocialController::class, 'handleGoogleCallback']);
Route::get('login/facebook', [SocialController::class, 'redirectToFacebook'])->name('facebook.login');
Route::get('login/facebook/callback', [SocialController::class, 'handleFacebookCallback']);

// Authenticated
Route::middleware('auth')->group(function () {

    // Admin area
    Route::prefix('admin')
        ->name('admin.')
        ->group(function () {

            // Dashboard
            Route::resource('dashboard', DashboardController::class)
                ->only('index')
                ->names(['index' => 'dashboard'])
                ->middleware('can:view dashboard');

            // Users
            Route::resource('users', UserController::class)
                ->middleware('can:view users');

            // People CRUD (new section)
            Route::resource('people', \App\Http\Controllers\Admin\PeopleController::class)
                ->middleware('can:view people');
        });
});
