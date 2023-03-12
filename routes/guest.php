<?php

use App\Helpers\AuthRoutes;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use Illuminate\Support\Facades\Route;

Route::getAs(AuthRoutes::login, [AuthenticatedSessionController::class, 'create']);
Route::postAs(AuthRoutes::login_store, [AuthenticatedSessionController::class, 'store']);
