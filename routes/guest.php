<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Routes;
use Illuminate\Support\Facades\Route;

Route::getFromEnum(Routes::login, [AuthenticatedSessionController::class, 'create']);
Route::postFromEnum(Routes::login_store, [AuthenticatedSessionController::class, 'store']);
