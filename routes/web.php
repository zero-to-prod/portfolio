<?php

use App\Helpers\Routes;
use App\Helpers\Views;
use App\Http\Controllers\Admin\File\FileServeResponse;
use App\Http\Controllers\ConnectStoreRedirect;
use App\Http\Controllers\ResultsView;
use App\Http\Controllers\SearchRedirect;
use App\Models\Post;
use Illuminate\Support\Facades\Route;

Route::getAs(Routes::file, FileServeResponse::class);
Route::getAs(Routes::cv, Views::cv, cached: true);
Route::getAs(Routes::connect, Views::connect);
Route::postAs(Routes::search, SearchRedirect::class);
Route::getAs(Routes::results, ResultsView::class);
Route::getAs(Routes::read, function (Post $post) {
    return cached_view(Views::read_post, ['post' => $post], ttl: 60 * 5);
});
Route::postAs(Routes::connect_store, ConnectStoreRedirect::class);
Route::getAs(Routes::welcome, Views::welcome, cached: true);

