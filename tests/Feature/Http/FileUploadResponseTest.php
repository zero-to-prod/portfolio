<?php

namespace Http;

use App\Helpers\Routes;
use App\Http\Controllers\Admin\File\FileServeResponse;
use App\Http\Controllers\Admin\File\FileUploadResponse;
use App\Models\File;
use Config;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Storage;
use Tests\AuthTestCase;

class FileUploadResponseTest extends AuthTestCase
{
    use RefreshDatabase;

    /**
     * @test
     * @see FileUploadResponse
     */
    public function file_upload(): void
    {
        Storage::fake(config('filesystems.file_disk'));
        $file = UploadedFile::fake()->create('document.pdf', 1000, 'application/pdf');

        $response = $this->postAs(Routes::upload, ['file' => $file]);

        $response->assertRedirect();
        $this->assertDatabaseHas((new File)->getTable(), [
            File::name => $file->hashName(),
            File::original_name => $file->getClientOriginalName(),
            File::mime_type => $file->getMimeType(),
        ]);
        Storage::disk(config('filesystems.file_disk'))->assertExists(Config::get('filesystems.file_disk_path') . $file->hashName());
    }

    /**
     * @test
     * @see FileServeResponse
     */
    public function cache_retrieval(): void
    {
        Storage::fake(config('filesystems.file_disk'));

        $response = $this->postAs(Routes::upload);

        $response->assertBadRequest();
        $this->assertDatabaseCount((new File)->getTable(), 0);
    }
}
