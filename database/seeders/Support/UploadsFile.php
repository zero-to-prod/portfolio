<?php

namespace Database\Seeders\Support;

use App\Models\File;
use Storage;

trait UploadsFile
{
    protected function uploadFile(string $name, string $mime_type = 'image/png'): File
    {
        $file = Storage::disk('local')->path($name);
        $bucket_path = config('filesystems.disks.s3.bucket_path');
        $file = Storage::disk('s3')->putFile($bucket_path, $file);

        return File::create([
            File::path => $bucket_path,
            File::name => explode($bucket_path . '/', $file)[1],
            File::original_name => $name,
            File::mime_type => $mime_type
        ]);
    }
}
