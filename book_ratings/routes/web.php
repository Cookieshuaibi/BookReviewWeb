<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\BookController;
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

/**books */
Route::any('/books/create', [BookController::class, 'create'])->name('books.create');
Route::any('/books/edit/{id}', [BookController::class, 'edit'])->name('books.edit');
Route::delete('/books/{id}', [BookController::class, 'delete'])->name('books.destroy');
Route::GET('/books', [BookController::class, 'index'])->name('books.index');
Route::get('/books/show/{id}', [BookController::class, 'show'])->name('books.show');
Route::post('/books/{book_id}/add_review', [BookController::class, 'add_review'])->name('books.add_review');
/**reviews */
Route::get('/my_reviews',[UserController::class, 'myReviews'])->name('myReviews')->middleware('auth');
Route::get('/users/{user}', [UserController::class, 'show'])->name('users.show');
// Notifications
Route::get('/notifications/unread-count', [NotificationController::class, 'unreadCount'])->name('notifications.unread-count')->middleware('auth');
Route::get('/notifications/top', [NotificationController::class, 'top'])->name('notifications.top')->middleware('auth');
Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications')->middleware('auth');
Route::get('/notifications/{id}', [NotificationController::class, 'show'])->name('notifications.show');

Route::prefix('/admin')->middleware('role:admin')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('admin.index');
});