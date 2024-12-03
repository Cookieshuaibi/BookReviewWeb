<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\UserController;
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
//    return view('welcome');
    echo "Hello World";
});

Route::any('/register', [RegisterController::class, 'register'])->name('register');

Route::any('/login', [LoginController::class, 'login'])->name('login');

Route::get('/profile',[UserController::class, 'profile'])->name('profile')->middleware('auth');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth');

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::any('/search', [SearchController::class, 'search'])->name('search.search');


// Notifications
Route::get('/notifications/unread-count', [NotificationController::class, 'unreadCount'])->name('notifications.unread-count')->middleware('auth');
Route::get('/notifications/top', [NotificationController::class, 'top'])->name('notifications.top')->middleware('auth');
Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications')->middleware('auth');
Route::get('/notifications/{id}', [NotificationController::class, 'show'])->name('notifications.show');

