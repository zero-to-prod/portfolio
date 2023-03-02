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
        return Cache::remember($request->fullUrl(), null, static function () use ($request) {
            $s3_bucket_path = config('filesystems.disks.s3.bucket_path');
            $path = $s3_bucket_path . explode('file', $request->path())[1];

            $file = Storage::disk('s3')->get($path);
            $mime = Storage::disk('s3')->mimeType($path);

            if (Str::contains($mime, 'image')) {
                $img = Image::make($file);
                if ($request->hasAny(['width', 'height'])) {
                    $img->encode('webp')
                        ->resize($request->width, $request->height, function ($constraint) {
                            $constraint->aspectRatio();
                        });
                }

                return $img->response();
            }

            return response($file, 200, ['Content-Type' => $mime]);
        });
    }
}
