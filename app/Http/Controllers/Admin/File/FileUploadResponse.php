<?php

namespace App\Http\Controllers\Admin\File;

use App\Http\Controllers\Controller;
use App\Models\File;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Upload;

class FileUploadResponse extends Controller
{
    public const file = 'file';

    /**
     * @see FileUploadControllerTest
     */
    public function __invoke(Request $request): Response|RedirectResponse|Application|ResponseFactory
    {
        $file = $request->file(self::file);
        if ($file) {
            File::upload($file);

            return redirect()->back();
        }

        return response('Missing file', 400);
    }
}
