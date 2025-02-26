<?php

use App\Http\Controllers\Admin\AboutController as AdminAboutController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\ClientsController;
use App\Http\Controllers\Admin\HomeController as AdminHomeController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\SkillController;
use App\Http\Controllers\Admin\TeamController;
use App\Http\Controllers\Admin\TestimonialController;
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
use App\Http\Controllers\frontend\AboutController;
use App\Http\Controllers\frontend\BlogController;
use App\Http\Controllers\frontend\ContactController;
use App\Http\Controllers\frontend\HomeController;
use App\Http\Controllers\frontend\PortfolioController;
use App\Http\Controllers\frontend\PricingController;
use App\Http\Controllers\frontend\ServicesController;
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

<<<<<<< HEAD
Route::get('/', function () {
    // return view('dashboard');
    // return view('admin.dashboard');
    return view('frontend.home');
=======
Route::middleware('isAdmin')->group(function () {
   

    Route::get('/dashboard',function(){
         return view('admin.dashboard');
    })->name('admin.dashboard');
    // ->name('admin.dashboard');
    // return view('frontend.home');
>>>>>>> fc1df20a0229c598a55baba4319eecb6017536cc
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



// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');


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


    /////////// Admin Services /////////// 

    // Route::resource('/admin-home', AdminHomeController::class);
    Route::resource('/admin-service', ServiceController::class);
    Route::get('/admin-service-serarch', [ServiceController::class, 'serviceSearch'])->name('admin-service.search');


    /////////// Admin About /////////// 
    Route::resource('/admin-about', AdminAboutController::class);
    Route::resource('/admin-team', TeamController::class);
    Route::resource('/admin-client', ClientsController::class);
    Route::resource('/admin-skill', SkillController::class);
    Route::resource('/admin-testimonial', TestimonialController::class);
});


// user LogOut 
Route::get('/user-logout', [UserController::class, 'logOut'])->name('user.logout');


//////////////  FrontEnd Controller //////////////



//////////////  Home Controller //////////////

Route::get('front-home', [HomeController::class, 'index'])->name('front.home');
Route::get('front-home-about', [HomeController::class, 'about']);
Route::get('front-home-services', [HomeController::class, 'services']);
Route::get('front-home-portfolio', [HomeController::class, 'portfolio']);
// Route::get('front-home-clients', [HomeController::class, 'clients']);
Route::get('/front-get-home', [HomeController::class, 'getHome'])->name('front.getHome');

Route::get('front-about', [AboutController::class, 'about'])->name('front.about');
Route::get('front-about-team', [AboutController::class, 'team'])->name('front.about.team');
Route::get('front-about-testimonials', [AboutController::class, 'testimonials'])->name('front.about.testimonials');
Route::get('front-services', [ServicesController::class, 'services'])->name('front.services');
Route::get('front-portfolio', [PortfolioController::class, 'portfolio'])->name('front.portfolio');
Route::get('front-portfolio-details', [PortfolioController::class, 'portfolioDetails'])->name('front.portfolio.details');
Route::get('front-pricing', [PricingController::class, 'pricing'])->name('front.pricing');
Route::get('front-blog', [BlogController::class, 'blog'])->name('front.blog');
Route::get('front-blog-single', [BlogController::class, 'singleBlog'])->name('front.blog.single');
Route::get('front-contact', [ContactController::class, 'contact'])->name('front.contact');
