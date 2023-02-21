<?php

use App\Http\Controllers\ConnectController;
use App\Http\Routes;
use App\Http\Views;
use Illuminate\Support\Facades\Route;

Route::getFromEnum(Routes::cv, fn() => view(Views::cv->value));
Route::getFromEnum(Routes::connect, fn() => view(Views::connect->value));
Route::postFromEnum(Routes::connect_store, ConnectController::class);
Route::getFromEnum(Routes::welcome, fn() => view(Views::welcome->value));
