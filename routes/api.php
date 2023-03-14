<?php
/** @noinspection StaticClosureCanBeUsedInspection */

use App\Helpers\Routes;
use App\Http\Controllers\Api\SubscribeResponse;
use App\Http\Controllers\Api\ThanksResponse;
use Illuminate\Support\Facades\Route;

Route::postAs(Routes::api_v1_subscribe, SubscribeResponse::class);
Route::postAs(Routes::api_v1_thanks, ThanksResponse::class);
