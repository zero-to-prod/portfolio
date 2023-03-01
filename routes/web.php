<?php

use App\Http\Controllers\ConnectStoreController;
use App\Http\Routes;
use App\Http\Views;
use App\Models\Post;
use Illuminate\Support\Facades\Route;

Route::getAs(Routes::cv, Views::cv, cached: true);
Route::getAs(Routes::connect, Views::connect);
Route::getAs(Routes::blog_post, function (Post $post) {
    return cached_view(Views::blog_post, ['post' => $post], ttl: 60 * 5);
});
Route::postAs(Routes::connect_store, ConnectStoreController::class);
Route::getAs(Routes::welcome, Views::welcome, cached: true);

