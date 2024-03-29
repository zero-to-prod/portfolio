<?php

namespace App\Http\Controllers\Admin\File;

use App\Http\Controllers\Controller;
use Cache;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Image;
use Storage;
use Str;

class FileResponse extends Controller
{
    public const file = 'file';
    public const width = 'width';
    public const height = 'height';

    /**
     * @see FileTest
     */
    public function __invoke(Request $request):  Application|ResponseFactory|Response
    {
        return Cache::rememberForever($request->fullUrl(), static function () use ($request) {
            $s3_bucket_path = config('filesystems.file_disk_path');
            $path = $s3_bucket_path . explode(self::file, $request->path())[1];

            $file = Storage::disk(config('filesystems.file_disk'))->get($path);
            $mime = Storage::disk(config('filesystems.file_disk'))->mimeType($path);

            if (Str::contains($mime, 'gif')) {
                return response($file, 200, ['Content-Type' => $mime]);
            }

            if (Str::contains($mime, 'image')) {
                $img = Image::make($file);
                if ($request->hasAny([self::width, self::height])) {
                    $img->encode('webp', 100)
                        ->resize($request->{self::width}, $request->{self::height}, function ($constraint) {
                            $constraint->aspectRatio();
                        });
                }

                return $img->response();
            }

            return response($file, 200, ['Content-Type' => $mime]);
        });
    }
}
