<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\Auth\{
    NewPasswordController,
    VerifyEmailController,
    RegisteredUserController,
    PasswordResetLinkController,
    ConfirmablePasswordController,
    AuthenticatedSessionController,
    EmailVerificationPromptController,
    EmailVerificationNotificationController
};

// Route::middleware('guest:customer')->group(function () {

//     Route::get('/register', [RegisteredUserController::class, 'create'])
//         ->middleware('guest:customer')
//         ->name('register');

//     Route::post('/register', [RegisteredUserController::class, 'store'])
//         ->middleware('guest:customer');

//     Route::get('/login', [AuthenticatedSessionController::class, 'create'])
//         ->middleware('guest:customer')
//         ->name('login');

//     Route::post('/login', [AuthenticatedSessionController::class, 'store'])
//         ->middleware('guest:customer');

//     Route::get('/forgot-password', [PasswordResetLinkController::class, 'create'])
//         ->middleware('guest:customer')
//         ->name('password.request');

//     Route::post('/forgot-password', [PasswordResetLinkController::class, 'store'])
//         ->middleware('guest:customer')
//         ->name('password.email');

//     Route::get('/reset-password/{token}', [NewPasswordController::class, 'create'])
//         ->middleware('guest:customer')
//         ->name('password.reset');

//     Route::post('/reset-password', [NewPasswordController::class, 'store'])
//         ->middleware('guest:customer')
//         ->name('password.update');

//     Route::get('/verify-email', [EmailVerificationPromptController::class, '__invoke'])
//         ->middleware('auth')
//         ->name('verification.notice');

//     Route::get('/verify-email/{id}/{hash}', [VerifyEmailController::class, '__invoke'])
//         ->middleware(['auth:customer', 'signed', 'throttle:6,1'])
//         ->name('verification.verify');

//     Route::post('/email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
//         ->middleware(['auth:customer', 'throttle:6,1'])
//         ->name('verification.send');

//     Route::get('/confirm-password', [ConfirmablePasswordController::class, 'show'])
//         ->middleware('auth:customer')
//         ->name('password.confirm');

//     Route::post('/confirm-password', [ConfirmablePasswordController::class, 'store'])
//         ->middleware('auth:customer');

//     Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
//         ->middleware('auth:customer')
//         ->name('logout');
// });
