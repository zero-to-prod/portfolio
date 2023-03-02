<?php

namespace App\Http\Controllers;

use App\Models\File;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class FileUploadController extends Controller
{
    /**
     * @see FileUploadControllerTest
     */
    public function __invoke(Request $request): Response|RedirectResponse|Application|ResponseFactory
    {
        $file = $request->file('file');
        if ($file) {
            $aws_file_path = $file->store(config('filesystems.disks.s3.bucket_path'), 's3');
            $name = explode(config('filesystems.disks.s3.bucket_path') . '/', $aws_file_path)[1];
            File::create([
                File::path => config('filesystems.disks.s3.bucket_path'),
                File::name => $name,
                File::original_name => $file->getClientOriginalName(),
                File::mime_type => $file->getMimeType(),
            ]);

            return redirect()->back();
        }

        return response('Missing file', 400);
    }
}
