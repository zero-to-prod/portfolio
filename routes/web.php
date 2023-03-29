<?php
/** @noinspection StaticClosureCanBeUsedInspection */

use App\Helpers\Drivers;
use App\Helpers\Middlewares;
use App\Http\Controllers\Admin\File\FileResponse;
use App\Http\Controllers\Auth\GithubCallback;
use App\Http\Controllers\Auth\GoogleCallback;
use App\Http\Controllers\Auth\Login;
use App\Http\Controllers\Newsletter;
use App\Http\Controllers\Read;
use App\Http\Controllers\Register\Store as RegisterStore;
use App\Http\Controllers\Results;
use App\Http\Controllers\Search;
use App\Http\Controllers\Store as ConnectStore;
use App\Http\Controllers\SubscribeAddPassword;
use App\Http\Controllers\SubscribeSuccess;
use App\Http\Controllers\Welcome;
use Illuminate\Support\Facades\Route;

Route::feeds();

Route::getAs(to()->welcome, Welcome::class);
Route::getAs(to()->read, Read::class);
Route::postAs(to()->search, Search::class);
Route::getAs(to()->results, Results::class);
Route::getAs(to()->results, Results::class);
Route::getAs(to()->logo, fn() => response(file_get_contents('logo.png'), headers: ['Content-Type' => 'image/png']));

/* 31536000 = 1 year */
Route::middleware('cache.headers:public;max_age=31536000;etag')->group(function () {
    Route::getAs(to()->file, FileResponse::class);
});

/* Subscription */
Route::getAs(to()->newsletter, Newsletter::class);
Route::getAs(to()->subscribe, fn() => view('pages.subscribe.index'));
Route::getAs(to()->subscribe_success, SubscribeSuccess::class);
Route::getAs(to()->subscribe_addPassword, SubscribeAddPassword::class);

/* Login */
Route::getAs(to()->login->index, fn() => view('pages.login'));
Route::postAs(to()->login->store, Login::class);
/* Github */
Route::getAs(to()->auth->github->callback, GithubCallback::class);
Route::getAs(to()->auth->github->index, fn() => Socialite::driver(Drivers::github->value)->redirect());
/* Google */
Route::getAs(to()->auth->google->callback, GoogleCallback::class);
Route::getAs(to()->auth->google->index, fn() => Socialite::driver(Drivers::google->value)->redirect());

/* Register */
Route::getAs(to()->register->index, fn() => view('pages.register.index'));
Route::postAs(to()->register->store, RegisterStore::class);
Route::middlewareAs(Middlewares::signed)->group(function () {
    Route::getAs(to()->register->notice, fn() => view('pages.register.notice'));
    Route::getAs(to()->register->verification, fn() => view('pages.register.verification'));
});

/* Contact */
Route::getAs(to()->contact, fn() => view('pages.contact'));
Route::postAs(to()->contact_store, ConnectStore::class);

/* Legal */
Route::getAs(to()->tos, fn() => view('pages.tos'));
Route::getAs(to()->privacy, fn() => view('pages.privacy'));