<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\FileUploadController;
use App\Http\Controllers\PostPublishController;
use App\Http\Controllers\PostStoreController;
use App\Http\Controllers\PostUnPublishController;
use App\Http\Controllers\ProfileController;
use App\Http\Middleware;
use App\Http\Routes;
use App\Http\Views;
use Illuminate\Support\Facades\Route;

Route::postAs(Routes::upload, FileUploadController::class);
Route::getAs(Routes::dashboard, Views::dashboard)->middlewareAs(Middleware::verified);
Route::getAs(Routes::admin_posts, Views::admin_posts);
Route::getAs(Routes::admin_posts_create, Views::admin_posts_form);
Route::getAs(Routes::admin_posts_edit, Views::admin_posts_form);
Route::postAs(Routes::admin_posts_store, PostStoreController::class);
Route::postAs(Routes::admin_posts_publish, PostPublishController::class);
Route::postAs(Routes::admin_posts_unPublish, PostUnPublishController::class);
Route::getAs(Routes::profile_edit, [ProfileController::class, 'edit']);
Route::patchAs(Routes::profile_update, [ProfileController::class, 'update']);
Route::deleteAs(Routes::profile_destroy, [ProfileController::class, 'destroy']);
Route::getAs(Routes::email_verificationNotice, EmailVerificationPromptController::class);
Route::getAs(Routes::email_verify, VerifyEmailController::class)
    ->middlewareAs([Middleware::signed, Middleware::throttle->value . ':6,1']);
Route::postAs(Routes::email_verificationNotification, [EmailVerificationNotificationController::class, 'store'])
    ->middlewareAs(Middleware::throttle->value . ':6,1');
Route::getAs(Routes::password_confirm, [ConfirmablePasswordController::class, 'show']);
Route::postAs(Routes::password_store, [ConfirmablePasswordController::class, 'store']);
Route::putAs(Routes::password_update, [PasswordController::class, 'update']);
Route::postAs(Routes::logout, [AuthenticatedSessionController::class, 'destroy']);
