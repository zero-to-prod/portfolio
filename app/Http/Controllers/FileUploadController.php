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
            $bucket_path = config('filesystems.file_disk_path');
            $file_path = $file->store($bucket_path, config('filesystems.file_disk'));
            File::create([
                File::path => $bucket_path,
                File::name => explode($bucket_path . '/', $file_path)[1],
                File::original_name => $file->getClientOriginalName(),
                File::mime_type => $file->getMimeType(),
            ]);

            return redirect()->back();
        }

        return response('Missing file', 400);
    }
}
