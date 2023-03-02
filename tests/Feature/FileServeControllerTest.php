<?php


use App\Http\Routes;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class FileServeControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     * @see FileServeController
     */
    public function file_download(): void
    {
        $filename = 'testfile.txt';
        $path = config('filesystems.disks.s3.bucket_path') . '/';
        $fileContent = 'test file content';
        $mimeType = 'text/plain; charset=UTF-8';

        Storage::fake('s3');
        Storage::disk('s3')->put($path . $filename, $fileContent);
        Storage::disk('s3')->assertExists($path . $filename);

        $response = $this->getAs(Routes::file, [$filename]);

        $response->assertStatus(200);
        $response->assertHeader('Content-Type', $mimeType);
        $response->assertSee($fileContent);

        Storage::disk('s3')->delete($path . $filename);
    }

    /**
     * @test
     * @see FileServeController
     */
    public function cache_retrieval(): void
    {
        $filename = 'testfile.txt';
        $fileContent = 'test file content';
        $mimeType = 'text/plain; charset=UTF-8';

        Cache::shouldReceive('remember')
            ->once()
            ->with($filename, null, \Closure::class)
            ->andReturn(['file' => $fileContent, 'mime' => $mimeType]);

        $response = $this->getAs(Routes::file, [$filename]);

        $response->assertStatus(200);
        $response->assertHeader('Content-Type', $mimeType);
        $response->assertSee($fileContent);
    }
}
