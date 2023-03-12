<?php

use App\Helpers\AuthRoutes;
use App\Helpers\Middlewares;
use App\Http\Controllers\Admin\File\FileUploadResponse;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/* Files */
Route::postAs(AuthRoutes::upload, FileUploadResponse::class);

/* Profile */
Route::getAs(AuthRoutes::profile_edit, [ProfileController::class, 'edit']);
Route::patchAs(AuthRoutes::profile_update, [ProfileController::class, 'update']);
Route::deleteAs(AuthRoutes::profile_destroy, [ProfileController::class, 'destroy']);

/* Email */
Route::getAs(AuthRoutes::email_verificationNotice, EmailVerificationPromptController::class);
Route::getAs(AuthRoutes::email_verify, VerifyEmailController::class)
    ->middlewareAs([Middlewares::signed, Middlewares::throttle->value . ':6,1']);
Route::postAs(AuthRoutes::email_verificationNotification, [EmailVerificationNotificationController::class, 'store'])
    ->middlewareAs(Middlewares::throttle->value . ':6,1');

/* Auth */
Route::getAs(AuthRoutes::password_confirm, [ConfirmablePasswordController::class, 'show']);
Route::postAs(AuthRoutes::password_store, [ConfirmablePasswordController::class, 'store']);
Route::postAs(AuthRoutes::logout, [AuthenticatedSessionController::class, 'destroy']);
Route::putAs(AuthRoutes::password_update, [PasswordController::class, 'update']);
