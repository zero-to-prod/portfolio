<?php
/** @noinspection StaticClosureCanBeUsedInspection */

use App\Helpers\Drivers;
use App\Helpers\Middlewares;
use App\Http\Controllers\Admin\File\FileResponse;
use App\Http\Controllers\Auth\GithubCallback;
use App\Http\Controllers\Auth\Login;
use App\Http\Controllers\Newsletter;
use App\Http\Controllers\Read;
use App\Http\Controllers\Register\Store as RegisterStore;
use App\Http\Controllers\Results;
use App\Http\Controllers\Search;
use App\Http\Controllers\Store as ConnectStore;
use App\Http\Controllers\Welcome;
use Illuminate\Support\Facades\Route;

Route::getAs(to()->welcome, Welcome::class);
Route::getAs(to()->read, Read::class);
Route::postAs(to()->search, Search::class);
Route::getAs(to()->results, Results::class);

/* 2592000 = 30 days */
Route::middleware('cache.headers:public;max_age=2592000;etag')->group(function () {
    Route::getAs(to()->file, FileResponse::class);
});

/* Subscription */
Route::getAs(to()->newsletter, Newsletter::class);
Route::getAs(to()->subscribe, fn() => view('subscribe'));

/* Login */
Route::getAs(to()->login->index, fn() => view('login'));
Route::postAs(to()->login->store, Login::class);
Route::getAs(to()->auth->github->callback, GithubCallback::class);
Route::getAs(to()->auth->github->index, fn() => Socialite::driver(Drivers::github->value)->redirect());

/* Register */
Route::getAs(to()->register->index, fn() => view('register.index'));
Route::postAs(to()->register->store, RegisterStore::class);
Route::middlewareAs(Middlewares::signed)->group(function () {
    Route::getAs(to()->register->notice, fn() => view('register.notice'));
    Route::getAs(to()->register->verification, fn() => view('register.verification'));
});

/* Contact */
Route::getAs(to()->contact, fn() => view('contact'));
Route::postAs(to()->contact_store, ConnectStore::class);

/* Legal */
Route::getAs(to()->tos, fn() => view('tos'));
Route::getAs(to()->privacy, fn() => view('privacy'));