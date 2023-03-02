<?php

namespace App\Http\Controllers;

use Cache;
use Illuminate\Http\Request;
use Image;
use Storage;
use Str;

class FileServeController extends Controller
{
    /**
     * @see FileServeControllerTest
     */
    public function __invoke(Request $request)
    {
        $path = config('filesystems.disks.s3.bucket_path') . '/';
        $filename = explode('file/', $request->path())[1];
        $file = Cache::remember($filename, null, static function () use ($path, $filename) {
            return Storage::disk('s3')->get($path . $filename);
        });

        if (Cache::has($request->fullUrl())) {
            return Cache::get($request->fullUrl());
        }
        $s3 = Storage::disk('s3');
        if (Str::contains($s3->mimeType($path . $filename), 'image')) {
            $imgFile = Image::make($file);
            if ($request->hasAny(['width', 'height'])) {
                $imgFile->resize($request->width ?? null, $request->height ?? null, function ($constraint) {
                    $constraint->aspectRatio();
                });
            }

            Cache::put($request->fullUrl(), $imgFile->response());

            return $imgFile->response();
        }

        Cache::put($request->fullUrl(), $s3->get($path . $filename));

        return Storage::disk('s3')->response($path . $filename);
    }
}

//if (Cache::has($img)) {
//    $file = Cache::get($img);
//
//    return response($file['file'], headers: ['Content-Type' => $file['mime']]);
//}
//
//$path = config('filesystems.disks.s3.bucket_path') . '/';
//$file = Storage::disk('s3');
//Cache::put($img, ['file' => $file->get($path . $img), 'mime' => $file->mimeType($path . $img)]);
//
//return Storage::disk('s3')->response($path . $img);
