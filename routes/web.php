<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Auth\SocialController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\PeopleController;
use App\Http\Controllers\LandingController;
use Illuminate\Support\Facades\DB;


// =================== PUBLIC ===================

Route::get('/fix-genders', function () {
    DB::table('people')->whereIn('gender', ['male', 'M'])->update(['gender' => 'Male']);
    DB::table('people')->whereIn('gender', ['female', 'F'])->update(['gender' => 'Female']);
    DB::table('people')->whereNull('gender')->update(['gender' => 'Unknown']);
    return 'Gender values normalized ✅';
});




// Landing page + CNP search
Route::get('/', [LandingController::class, 'index']);
Route::post('/search-person', [LandingController::class, 'searchPerson'])->name('search.person');

// Authentication
Route::get('/login',     [AuthController::class, 'loginform'])->name('loginform');
Route::post('/login',    [AuthController::class, 'login'])->name('login');
Route::get('/register',  [AuthController::class, 'registerform'])->name('registerform');
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/logout',   [AuthController::class, 'logout'])->name('logout');
Route::view('/error',    'auth.errors.error403')->name('auth.error403');

// Social Logins
Route::get('login/google',            [SocialController::class, 'redirectToGoogle'])->name('google.login');
Route::get('login/google/callback',   [SocialController::class, 'handleGoogleCallback']);
Route::get('login/facebook',          [SocialController::class, 'redirectToFacebook'])->name('facebook.login');
Route::get('login/facebook/callback', [SocialController::class, 'handleFacebookCallback']);


// =================== AUTHENTICATED ===================

Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Users
    Route::resource('users', UserController::class)
        ->middleware('can:view users');

    // Password Management
    Route::get('change-password', [UserController::class, 'showChangePasswordForm'])->name('change-password.form');
    Route::post('change-password', [UserController::class, 'updatePassword'])->name('change-password.update');

    // People CRUD
    Route::resource('people', PeopleController::class)
        ->middleware('can:view people');
});
