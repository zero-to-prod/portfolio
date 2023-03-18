<?php

use App\Helpers\Middlewares;
use App\Helpers\Routes;
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
Route::postAs(Routes::auth_upload, FileUploadResponse::class);

/* Profile */
Route::getAs(Routes::auth_profile_edit, [ProfileController::class, 'edit']);
Route::patchAs(Routes::auth_profile_update, [ProfileController::class, 'update']);
Route::deleteAs(Routes::auth_profile_destroy, [ProfileController::class, 'destroy']);

/* Email */
Route::getAs(Routes::auth_email_verificationNotice, EmailVerificationPromptController::class);
Route::getAs(Routes::auth_email_verify, VerifyEmailController::class)
    ->middlewareAs([Middlewares::signed, Middlewares::throttle->value . ':6,1']);
Route::postAs(Routes::auth_email_verificationNotification, [EmailVerificationNotificationController::class, 'store'])
    ->middlewareAs(Middlewares::throttle->value . ':6,1');

/* Auth */
Route::getAs(Routes::auth_password_confirm, [ConfirmablePasswordController::class, 'show']);
Route::postAs(Routes::auth_password_store, [ConfirmablePasswordController::class, 'store']);
Route::postAs(Routes::auth_logout, [AuthenticatedSessionController::class, 'destroy']);
Route::putAs(Routes::auth_password_update, [PasswordController::class, 'update']);

