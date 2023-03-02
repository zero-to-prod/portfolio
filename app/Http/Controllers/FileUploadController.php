<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Upload;

class FileUploadController extends Controller
{
    /**
     * @see FileUploadControllerTest
     */
    public function __invoke(Request $request): Response|RedirectResponse|Application|ResponseFactory
    {
        $file = $request->file('file');
        if ($file) {
            Upload::file($file);

            return redirect()->back();
        }

        return response('Missing file', 400);
    }
}
