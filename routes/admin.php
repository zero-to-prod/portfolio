<?php

use App\Helpers\Routes;
use App\Helpers\Views;
use App\Http\Controllers\Admin\Author\AuthorFormRedirect;
use App\Http\Controllers\Admin\Author\AuthorFormView;
use App\Http\Controllers\Admin\Author\AuthorIndexView;
use App\Http\Controllers\Admin\Post\PostFormRedirect;
use App\Http\Controllers\Admin\Post\PostFormView;
use App\Http\Controllers\Admin\Post\PostIndexView;
use App\Http\Controllers\Admin\Post\PostPublishRedirect;
use App\Http\Controllers\Admin\Post\PostUnPublishRedirect;
use App\Http\Controllers\Admin\Tag\TagFormRedirect;
use App\Http\Controllers\Admin\Tag\TagFormView;
use App\Http\Controllers\Admin\Tag\TagIndexView;
use Illuminate\Support\Facades\Route;

Route::middleware(['role:super_admin|contributor'])->group(function () {
    /* Dashboard */
    Route::getAs(Routes::dashboard, Views::dashboard);

    /* Posts */
    Route::getAs(Routes::admin_post_index, PostIndexView::class);
    Route::getAs(Routes::admin_post_create, PostFormView::class);
    Route::getAs(Routes::admin_post_edit, PostFormView::class);
    Route::postAs(Routes::admin_post_store, PostFormRedirect::class);
});

Route::middleware(['role:super_admin'])->group(function () {
    Route::postAs(Routes::admin_post_publish, PostPublishRedirect::class);
    Route::postAs(Routes::admin_post_unPublish, PostUnPublishRedirect::class);
    /* Tags */
    Route::getAs(Routes::admin_tag_index, TagIndexView::class);
    Route::getAs(Routes::admin_tag_create, TagFormView::class);
    Route::getAs(Routes::admin_tag_edit, TagFormView::class);
    Route::postAs(Routes::admin_tag_store, TagFormRedirect::class);

    /* Authors */
    Route::getAs(Routes::admin_author_index, AuthorIndexView::class);
    Route::getAs(Routes::admin_author_create, AuthorFormView::class);
    Route::getAs(Routes::admin_author_edit, AuthorFormView::class);
    Route::postAs(Routes::admin_author_store, AuthorFormRedirect::class);
});