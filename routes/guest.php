<?php

use App\Helpers\GuestRoutes;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use Illuminate\Support\Facades\Route;

Route::getAs(GuestRoutes::login, [AuthenticatedSessionController::class, 'create']);
Route::postAs(GuestRoutes::login_store, [AuthenticatedSessionController::class, 'store']);
