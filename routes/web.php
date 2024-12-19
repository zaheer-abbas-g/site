<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\MultiImagesController;
use App\Http\Controllers\MultipleImages;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;

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
    // return view('dashboard');
    return view('admin.dashboard');
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


Route::middleware('auth')->group(function () {

    Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
        ->middleware(['signed', 'throttle:6,1'])
        ->name('verification.verify');
});

Route::get('forgot-password', [PasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('forgot-password-sendResetLinkEmail', [PasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('/reset-password/{token}', [PasswordController::class, 'showResetForm'])
    ->name('password.reset');
Route::PUT('/reset-password', [PasswordController::class, 'reset'])
    ->name('password.update');



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


// require __DIR__ . '/auth.php';


Route::middleware('auth')->group(function () {

    Route::get('profile', [ProfileController::class, 'create'])->name('profile.edit');
    Route::put('profile-update', [ProfileController::class, 'profileUpdate']);
    Route::put('profile-password-update', [ProfileController::class, 'profileUpdatePassword']);

    Route::resource('/users', UserController::class);
    Route::resource('/categories', CategoryController::class);
    Route::get('categories-restore/{id}', [CategoryController::class, 'restore']);
    Route::resource('/brands', BrandController::class);
    Route::resource('/multipleimages', MultiImagesController::class);
});


// user LogOut 
Route::get('/user-logout', [UserController::class, 'logOut'])->name('user.logout');
