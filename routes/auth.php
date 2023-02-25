<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\ProfileController;
use App\Http\Views;
use Illuminate\Support\Facades\Route;
use App\Http\Routes;

Route::getAs(Routes::dashboard, Views::dashboard)->middleware(['verified']);
Route::getAs(Routes::profile_edit, [ProfileController::class, 'edit']);
Route::patchAs(Routes::profile_update, [ProfileController::class, 'update']);
Route::deleteAs(Routes::profile_destroy, [ProfileController::class, 'destroy']);
Route::getAs(Routes::email_verificationNotice, EmailVerificationPromptController::class);
Route::getAs(Routes::email_verify, VerifyEmailController::class)->middleware(['signed', 'throttle:6,1']);
Route::postAs(Routes::email_verificationNotification, [EmailVerificationNotificationController::class, 'store'])->middleware('throttle:6,1');
Route::getAs(Routes::password_confirm, [ConfirmablePasswordController::class, 'show']);
Route::postAs(Routes::password_store, [ConfirmablePasswordController::class, 'store']);
Route::putAs(Routes::password_update, [PasswordController::class, 'update']);
Route::postAs(Routes::logout, [AuthenticatedSessionController::class, 'destroy']);
