<?php

use App\Http\Controllers\admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\admin\LoginController as AdminLoginController;
use App\Http\Controllers\CandidateController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\VoteController;
use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});
Route::get('verify/{token}', [LoginController::class, 'verify']);
Route::group(['prefix' => 'account'], function () {
    // Guest middleware
    Route::group(['middleware' => 'guest'], function () {
        Route::get('login', [LoginController::class, 'index'])->name('account.login');
        Route::get('register', [LoginController::class, 'register'])->name('account.register');
        Route::post('process-register', [LoginController::class, 'processRegister'])->name('account.processRegister');
        Route::post('authenticate', [LoginController::class, 'authenticate'])->name('account.authenticate');
    });
    // Auth middleware
    Route::group(['middleware' => 'auth'], function () {
        Route::get('logout', [LoginController::class, 'logout'])->name('account.logout');
        Route::get('dashboard', [DashboardController::class, 'index'])->name('account.dashboard');
    });
});
///////////////////////////////////////////////////////////////////////////////
Route::group(['prefix' => 'admin'], function () {
    // Guest middleware
    Route::group(['middleware' => 'admin.guest'], function () {
        Route::post('authenticate', [AdminLoginController::class, 'authenticate'])->name('admin.authenticate');
        Route::get('login', [AdminLoginController::class, 'index'])->name('admin.login');
    });
    // Auth middleware
    Route::group(['middleware' => 'admin.auth'], function () {
        Route::get('dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
        Route::get('logout', [AdminLoginController::class, 'logout'])->name('admin.logout');
        Route::resource('candidates', CandidateController::class);  
    });
});

Route::post('/candidates/vote/{id}', [CandidateController::class, 'vote'])->name('candidates.vote');
