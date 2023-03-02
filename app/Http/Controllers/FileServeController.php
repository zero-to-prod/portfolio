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
        return Cache::remember($request->fullUrl(), config('filesystems.cache.ttl'), static function () use ($request) {
            $path = config('filesystems.disks.s3.bucket_path') . '/';
            $filename = explode('file/', $request->path())[1];
            $full_path = $path . $filename;

            $file = Storage::disk('s3')->get($full_path);
            $mime_type = Storage::disk('s3')->mimeType($full_path);

            if (Str::contains($mime_type, 'image')) {
                $imgFile = Image::make($file);

                if ($request->hasAny(['width', 'height'])) {
                    $imgFile->encode('webp')->resize($request->width ?? null, $request->height ?? null, function ($constraint) {
                        $constraint->aspectRatio();
                    });
                }
                $response = $imgFile->response();
            } else {
                $response = response($file, 200, ['Content-Type' => $mime_type]);
            }

            return $response;
        });
    }
}
