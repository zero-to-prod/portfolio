<?php

use App\Helpers\Middlewares;
use App\Helpers\Routes;
use App\Helpers\Views;
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
Route::postAs(Routes::upload, FileUploadResponse::class);

/* Dashboard */
Route::getAs(Routes::dashboard, Views::dashboard)->middlewareAs(Middlewares::verified);

/* Profile */
Route::getAs(Routes::profile_edit, [ProfileController::class, 'edit']);
Route::patchAs(Routes::profile_update, [ProfileController::class, 'update']);
Route::deleteAs(Routes::profile_destroy, [ProfileController::class, 'destroy']);

/* Email */
Route::getAs(Routes::email_verificationNotice, EmailVerificationPromptController::class);
Route::getAs(Routes::email_verify, VerifyEmailController::class)
    ->middlewareAs([Middlewares::signed, Middlewares::throttle->value . ':6,1']);
Route::postAs(Routes::email_verificationNotification, [EmailVerificationNotificationController::class, 'store'])
    ->middlewareAs(Middlewares::throttle->value . ':6,1');

/* Auth */
Route::getAs(Routes::password_confirm, [ConfirmablePasswordController::class, 'show']);
Route::postAs(Routes::password_store, [ConfirmablePasswordController::class, 'store']);
Route::postAs(Routes::logout, [AuthenticatedSessionController::class, 'destroy']);
Route::putAs(Routes::password_update, [PasswordController::class, 'update']);
