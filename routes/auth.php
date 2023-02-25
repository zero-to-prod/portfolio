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

Route::getFromEnum(Routes::dashboard, fn() => named_view(Views::dashboard))->middleware(['verified']);
Route::getFromEnum(Routes::profile_edit, [ProfileController::class, 'edit']);
Route::patchFromEnum(Routes::profile_update, [ProfileController::class, 'update']);
Route::deleteFromEnum(Routes::profile_destroy, [ProfileController::class, 'destroy']);
Route::getFromEnum(Routes::email_verificationNotice, EmailVerificationPromptController::class);
Route::getFromEnum(Routes::email_verify, VerifyEmailController::class)->middleware(['signed', 'throttle:6,1']);
Route::postFromEnum(Routes::email_verificationNotification, [EmailVerificationNotificationController::class, 'store'])->middleware('throttle:6,1');
Route::getFromEnum(Routes::password_confirm, [ConfirmablePasswordController::class, 'show']);
Route::postFromEnum(Routes::password_store, [ConfirmablePasswordController::class, 'store']);
Route::putFromEnum(Routes::password_update, [PasswordController::class, 'update']);
Route::postFromEnum(Routes::logout, [AuthenticatedSessionController::class, 'destroy']);
