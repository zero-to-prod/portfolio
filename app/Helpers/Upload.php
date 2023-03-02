<?php

namespace App\Helpers;

use App\Models\File;
use Illuminate\Http\UploadedFile;

class Upload
{
    public static function file(UploadedFile $file): ?File
    {
        $bucket_path = config('filesystems.file_disk_path');
        $file_path = $file->store($bucket_path, config('filesystems.file_disk'));

        return File::create([
            File::path => $bucket_path,
            File::name => explode($bucket_path . '/', $file_path)[1],
            File::original_name => $file->getClientOriginalName(),
            File::mime_type => $file->getMimeType(),
        ]);
    }
}