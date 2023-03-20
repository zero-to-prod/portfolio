<?php

use App\Helpers\Middlewares;
use App\Helpers\Routes;
use App\Http\Controllers\Admin\File\FileUploadResponse;
use App\Http\Controllers\Password\ConfirmablePasswordController;
use App\Http\Controllers\Password\PasswordController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Register\VerificationSend;
use Illuminate\Support\Facades\Route;

/* Files */
Route::postAs(Routes::auth_upload, FileUploadResponse::class);

/* Profile */
Route::getAs(Routes::auth_profile_edit, [ProfileController::class, 'edit']);
Route::patchAs(Routes::auth_profile_update, [ProfileController::class, 'update']);
Route::deleteAs(Routes::auth_profile_destroy, [ProfileController::class, 'destroy']);

/* Email */
Route::postAs(Routes::auth_email_verificationNotification, VerificationSend::class)
    ->middlewareAs(Middlewares::throttle->value . ':6,1');

/* Auth */
Route::getAs(Routes::auth_password_confirm, [ConfirmablePasswordController::class, 'show']);
Route::postAs(Routes::auth_password_store, [ConfirmablePasswordController::class, 'store']);
Route::putAs(Routes::auth_password_update, [PasswordController::class, 'update']);

