<?php

use App\Helpers\Routes;
use App\Helpers\Views;
use App\Http\Controllers\Admin\File\FileServeResponse;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\ConnectStoreRedirect;
use App\Http\Controllers\GithubCallback;
use App\Http\Controllers\GithubRedirect;
use App\Http\Controllers\LoginView;
use App\Http\Controllers\NewsletterView;
use App\Http\Controllers\PrivacyView;
use App\Http\Controllers\ReadView;
use App\Http\Controllers\RegisterNoticeView;
use App\Http\Controllers\RegisterView;
use App\Http\Controllers\ResultsView;
use App\Http\Controllers\SearchRedirect;
use App\Http\Controllers\SubscribeView;
use App\Http\Controllers\TermsOfServiceView;
use App\Http\Controllers\WelcomeView;
use Illuminate\Support\Facades\Route;

Route::getAs(Routes::auth_github_callback, GithubCallback::class);
Route::getAs(Routes::auth_github_index, GithubRedirect::class);
Route::getAs(Routes::contact, Views::contact);
Route::getAs(Routes::file, FileServeResponse::class);
Route::getAs(Routes::login, LoginView::class);
Route::getAs(Routes::register, RegisterView::class);
Route::getAs(Routes::register_notice, RegisterNoticeView::class);
Route::postAs(Routes::register_store, [RegisteredUserController::class, 'store']);
Route::getAs(Routes::privacy, PrivacyView::class);
Route::getAs(Routes::read, ReadView::class);
Route::getAs(Routes::results, ResultsView::class);
Route::getAs(Routes::newsletter, NewsletterView::class);
Route::getAs(Routes::subscribe, SubscribeView::class);
Route::getAs(Routes::tos, TermsOfServiceView::class);
Route::getAs(Routes::welcome, WelcomeView::class);
Route::postAs(Routes::connect_store, ConnectStoreRedirect::class);
Route::postAs(Routes::search, SearchRedirect::class);

Route::middleware('auth')->group(function () {
    Route::get('verify-email', EmailVerificationPromptController::class)
        ->name('verification.notice');

    Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
        ->middleware(['throttle:6,1'])
        ->name('verification.verify');

    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
        ->middleware('throttle:6,1')
        ->name('verification.send');

    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
        ->name('password.confirm');

    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

    Route::put('password', [PasswordController::class, 'update'])->name('password.update');

    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');
});