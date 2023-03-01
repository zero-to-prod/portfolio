<?php

use App\Http\Controllers\ConnectStoreController;
use App\Http\Routes;
use App\Http\Views;
use App\Models\File;
use App\Models\Post;
use Illuminate\Support\Facades\Route;

Route::postAs(Routes::upload, function (\Illuminate\Http\Request $request) {
    $bucket_path = config('filesystems.disks.s3.bucket_path');
    $aws_file_path = $request->file('file')?->store($bucket_path, 's3');
    $file = $request->file('file');
    File::create([
        File::path => $bucket_path,
        File::name => explode($bucket_path . '/', $aws_file_path)[1],
        File::original_name => $file->getClientOriginalName(),
        File::mime_type => $file->getMimeType(),
    ]);

    return redirect()->back();
});

Route::getAs(Routes::img, function ($img) {
    if (Cache::has($img)) {
        $file = Cache::get($img);

        return response($file['file'], headers: ['Content-Type' => $file['mime']]);
    }

    $path = config('filesystems.disks.s3.bucket_path') . '/';
    $file = Storage::disk('s3');
    Cache::put($img, ['file' => $file->get($path . $img), 'mime' => $file->mimeType($path . $img)]);

    return Storage::disk('s3')->response($path . $img);
});

Route::getAs(Routes::cv, Views::cv, cached: true);
Route::getAs(Routes::connect, Views::connect);
Route::getAs(Routes::blog_post, function (Post $post) {
    return cached_view(Views::blog_post, ['post' => $post], ttl: 60 * 5);
});
Route::postAs(Routes::connect_store, ConnectStoreController::class);
Route::getAs(Routes::welcome, Views::welcome, cached: true);

