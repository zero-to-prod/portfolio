<?php

use App\Http\Controllers\ConnectStoreController;
use App\Http\Routes;
use App\Http\Views;
use Illuminate\Support\Facades\Route;

Route::getAs(Routes::cv, Views::cv, cached: true);
Route::getAs(Routes::connect, Views::connect);
Route::getAs(Routes::blog_post, function($slug) {
    $post = \App\Models\Post::whereSlug($slug)->firstOrFail();
    $body = app(Spatie\LaravelMarkdown\MarkdownRenderer::class)
        ->highlightTheme('github-dark')
        ->toHtml($post->body);

    return cached_view(Views::blog_post)->with(compact( 'body', 'post'));
});
Route::postAs(Routes::connect_store, ConnectStoreController::class);
Route::getAs(Routes::welcome, Views::welcome, cached: true);
