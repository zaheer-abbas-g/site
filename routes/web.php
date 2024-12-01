<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\MultiImagesController;
use App\Http\Controllers\MultipleImages;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

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

Route::get('/', function () {
    return view('dashboard');
    // return view('admin.dashboard');
});
Route::get('/welcome', function () {
    return view('welcome');
});

// Admin Auth Routes 

Route::get('login', [AuthController::class, 'create'])
    ->name('login');
Route::post('login', [AuthController::class, 'store'])->name('login.store');

Route::get('register', [AuthController::class, 'registerCreate'])
    ->name('register');

Route::post('register-store', [AuthController::class, 'registerStore'])
    ->name('register.store');

Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// require __DIR__ . '/auth.php';

// Route::middleware('auth')->group(     () {
Route::resource('/users', UserController::class);
Route::resource('/categories', CategoryController::class);
Route::get('categories-restore/{id}', [CategoryController::class, 'restore']);
Route::resource('/brands', BrandController::class);
Route::resource('/multipleimages', MultiImagesController::class);
// });


// user LogOut 
Route::get('/user-logout', [UserController::class, 'logOut'])->name('user.logout');
