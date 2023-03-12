<?php

use App\Helpers\AdminRoutes;
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

/* Posts */
Route::getAs(AdminRoutes::post_index, PostIndexView::class);
Route::getAs(AdminRoutes::post_create, PostFormView::class);
Route::getAs(AdminRoutes::post_edit, PostFormView::class);
Route::postAs(AdminRoutes::post_store, PostFormRedirect::class);
Route::postAs(AdminRoutes::post_publish, PostPublishRedirect::class);
Route::postAs(AdminRoutes::post_unPublish, PostUnPublishRedirect::class);

/* Tags */
Route::getAs(AdminRoutes::tag_index, TagIndexView::class);
Route::getAs(AdminRoutes::tag_create, TagFormView::class);
Route::getAs(AdminRoutes::tag_edit, TagFormView::class);
Route::postAs(AdminRoutes::tag_store, TagFormRedirect::class);

/* Authors */
Route::getAs(AdminRoutes::author_index, AuthorIndexView::class);
Route::getAs(AdminRoutes::author_create, AuthorFormView::class);
Route::getAs(AdminRoutes::author_edit, AuthorFormView::class);
Route::postAs(AdminRoutes::author_store, AuthorFormRedirect::class);