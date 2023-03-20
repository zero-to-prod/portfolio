<?php
/** @noinspection StaticClosureCanBeUsedInspection */

use App\Helpers\Middlewares;
use App\Helpers\Routes;
use App\Helpers\Views;
use App\Http\Controllers\Admin\File\FileServeResponse;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Auth\VerificationVerify;
use App\Http\Controllers\ConnectStoreRedirect;
use App\Http\Controllers\GithubCallback;
use App\Http\Controllers\GithubRedirect;
use App\Http\Controllers\LoginStoreRedirect;
use App\Http\Controllers\NewsletterView;
use App\Http\Controllers\PrivacyView;
use App\Http\Controllers\ReadView;
use App\Http\Controllers\RegisterStoreRedirect;
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
/* Login */
Route::getAs(Routes::loginIndex, fn() => view('login'));
Route::postAs(Routes::login_store, LoginStoreRedirect::class);
/* Register */
Route::getAs(Routes::registerIndex, fn() => view('register.index'));
Route::postAs(Routes::register_store, RegisterStoreRedirect::class);
Route::middlewareAs(Middlewares::signed)->group(function () {
    Route::getAs(Routes::register_notice, fn() => view('register.notice'));
    Route::getAs(Routes::register_verification, fn() => view('register.verification'));
});
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

    Route::get(Routes::register_verify->value, VerificationVerify::class)
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