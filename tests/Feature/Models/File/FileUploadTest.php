<?php

namespace Tests\Feature\Models\File;

use App\Models\File;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class FileUploadTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     * @see File::upload()
     */
    public function uploads_a_file(): void
    {
        $file = UploadedFile::fake()->create('test.pdf', 1);
        $uploadedFile = File::upload($file);

        $this->assertInstanceOf(File::class, $uploadedFile);
        $this->assertDatabaseHas((new File)->getTable(), [
            File::id => $uploadedFile->id,
            File::original_name => 'test.pdf',
            File::mime_type => 'application/pdf',
        ]);
        self::assertNotNull($uploadedFile->name);
        self::assertEquals(config('filesystems.file_disk_path'), $uploadedFile->path);
    }
}
