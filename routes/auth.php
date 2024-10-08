<?php 

use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;

// Authentication routes
Route::get('/login', [LoginController::class, 'signIn'])->name('login');
// Route::get('/account-signIn', [CommonController::class, 'signIn'])->name('account.signin');
// Route::get('/register', [CommonController::class, 'signUp'])->name('account.signup');

// // Email verification
// Route::get('/email/verify', [RegisterController::class, 'verify'])->name('account.verify');
// Route::post('/email/verify/send', [RegisterController::class, 'verifyMail'])->name('account.verify.email');
// Route::get('/verify/{token}', [RegisterController::class, 'verifyToken'])->name('auth.verify.token');

// // User authentication post routes
Route::post('/login/submit', [LoginController::class, 'login'])->name('auth.login');
// Route::post('/register/submit', [RegisterController::class, 'register'])->name('auth.register');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// // Password reset routes
// Route::get('/account/forgot-password', [CommonController::class, 'forgotPassword'])->name('account.forgot.password');
// Route::post('/forgot-password', [ResetPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
// Route::get('/reset-password/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
// Route::post('/reset-password', [ResetPasswordController::class, 'reset'])->name('password.update');