<?php

namespace App\Http\Controllers;

use Cache;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Response;
use Storage;

class FileServeController extends Controller
{
    /**
     * @see FileServeControllerTest
     */
    public function __invoke($filename): Response|Application|ResponseFactory
    {
        $path = config('filesystems.disks.s3.bucket_path') . '/';
        $file = Cache::remember($filename, null, static function () use ($path, $filename) {
            $file = Storage::disk('s3')->get($path . $filename);
            $mime = Storage::disk('s3')->mimeType($path . $filename);
            return ['file' => $file, 'mime' => $mime];
        });

        return response($file['file'], headers: ['Content-Type' => $file['mime']]);
    }
}
