<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\BookController as AdminBookController;
use App\Http\Controllers\Admin\ReviewController as AdminReviewController;
use App\Http\Controllers\Admin\RoleController as AdminRoleController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReviewController;

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
    return redirect('/home');
});

Route::any('/register', [RegisterController::class, 'register'])->name('register');
Route::any('/login', [LoginController::class, 'login'])->name('login');

Route::get('/profile', [UserController::class, 'profile'])->name('profile')->middleware('auth');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth');

Route::get('/home', [HomeController::class, 'index'])->name('home');
/** three api routes for search */
Route::any('/search', [SearchController::class, 'search'])->name('search.search');

/**books */
Route::any('/books/create', [BookController::class, 'create'])->name('books.create')->middleware('role:author,admin');
Route::any('/books/edit/{id}', [BookController::class, 'edit'])->name('books.edit')->middleware('role:author,admin');
Route::delete('/books/{id}', [BookController::class, 'delete'])->name('books.destroy')->middleware('role:author,admin');
Route::GET('/books', [BookController::class, 'index'])->name('books.index');
Route::get('/books/show/{id}', [BookController::class, 'show'])->name('books.show');
Route::post('/books/{book_id}/add_review', [BookController::class, 'add_review'])->name('books.add_review')->middleware('auth');
Route::get('/books/{book_id}/reviews', [BookController::class, 'reviews'])->name('books.get_reviews');
/**reviews  */
Route::get('/my_reviews', [UserController::class, 'myReviews'])->name('myReviews')->middleware('auth');
Route::get('/users/{user}', [UserController::class, 'show'])->name('users.show');
Route::any('/reviews/{id}/edit', [ReviewController::class, 'update_review'])->name('reviews.edit')->middleware('auth');
Route::delete('/reviews/{id}', [ReviewController::class, 'delete_review'])->name('reviews.destroy')->middleware('auth');
Route::get('/reviews', [ReviewController::class, 'index'])->name('reviews.index');
// Notifications Routes
Route::get('/notifications/unread-count', [NotificationController::class, 'unreadCount'])->name('notifications.unread-count')->middleware('auth');
Route::get('/notifications/top', [NotificationController::class, 'top'])->name('notifications.top')->middleware('auth');
Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications')->middleware('auth');
Route::get('/notifications/{id}', [NotificationController::class, 'show'])->name('notifications.show')->middleware('auth');

/**admin routes */
Route::prefix('/admin')->middleware('role:admin')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('admin.index');
    Route::resource('/users', AdminUserController::class)->names('admin.users');
    Route::resource('/reviews', AdminReviewController::class)->names('admin.reviews');
    Route::resource('/books', AdminBookController::class)->names('admin.books');
    Route::resource('/roles', AdminRoleController::class)->names('admin.roles');
    Route::get('/roles/assign_users/{role}', [AdminRoleController::class, 'assign_users'])->name('admin.roles.assign_users');
});