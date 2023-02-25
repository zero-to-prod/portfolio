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

Route::getRoute(Routes::dashboard, Views::dashboard)->middleware(['verified']);
Route::getRoute(Routes::profile_edit, [ProfileController::class, 'edit']);
Route::patchRoute(Routes::profile_update, [ProfileController::class, 'update']);
Route::deleteRoute(Routes::profile_destroy, [ProfileController::class, 'destroy']);
Route::getRoute(Routes::email_verificationNotice, EmailVerificationPromptController::class);
Route::getRoute(Routes::email_verify, VerifyEmailController::class)->middleware(['signed', 'throttle:6,1']);
Route::postRoute(Routes::email_verificationNotification, [EmailVerificationNotificationController::class, 'store'])->middleware('throttle:6,1');
Route::getRoute(Routes::password_confirm, [ConfirmablePasswordController::class, 'show']);
Route::postRoute(Routes::password_store, [ConfirmablePasswordController::class, 'store']);
Route::putRoute(Routes::password_update, [PasswordController::class, 'update']);
Route::postRoute(Routes::logout, [AuthenticatedSessionController::class, 'destroy']);
