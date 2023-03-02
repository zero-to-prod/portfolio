<?php


use App\Http\Routes;
use App\Models\File;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class FileUploadControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     * @see FileUploadController
     */
    public function file_upload(): void
    {
        $this->be(User::factory()->create());
        Storage::fake('s3');
        $file = UploadedFile::fake()->create('document.pdf', 1000, 'application/pdf');

        $response = $this->postAs(Routes::upload, ['file' => $file]);

        $response->assertRedirect();
        $this->assertDatabaseHas((new File)->getTable(), [
            File::name => $file->hashName(),
            File::original_name => $file->getClientOriginalName(),
            File::mime_type => $file->getMimeType(),
        ]);
        Storage::disk('s3')->assertExists(Config::get('filesystems.disks.s3.bucket_path') . '/' . $file->hashName());
    }

    /**
     * @test
     * @see FileServeController
     */
    public function cache_retrieval(): void
    {
        $this->be(User::factory()->create());
        Storage::fake('s3');

        $response = $this->postAs(Routes::upload);

        $response->assertBadRequest();
        $this->assertDatabaseCount((new File)->getTable(), 0);
    }
}
