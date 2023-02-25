<?php

use App\Http\Controllers\ConnectStoreController;
use App\Http\Routes;
use App\Http\Views;
use Illuminate\Support\Facades\Route;

Route::getFromEnum(Routes::cv, fn() => cached_view(Views::cv));
Route::getFromEnum(Routes::connect, fn() => cached_view(Views::connect));
Route::postFromEnum(Routes::connect_store, ConnectStoreController::class);
Route::getFromEnum(Routes::welcome, fn() => cached_view(Views::welcome));
