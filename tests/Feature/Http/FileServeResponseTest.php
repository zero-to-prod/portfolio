<?php

namespace Http;

use App\Http\Controllers\Admin\File\FileServeResponse;
use App\Models\File;
use Cache;
use Closure;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Storage;
use Tests\TestCase;

class FileServeResponseTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     * @see FileServeResponse
     */
    public function file_download(): void
    {
        $filename = 'test.txt';
        $path = config('filesystems.file_disk_path');
        $fileContent = 'test file content';
        $mimeType = 'text/plain; charset=UTF-8';

        Storage::fake(config('filesystems.file_disk'));
        Storage::disk(config('filesystems.file_disk'))->put($path . $filename, $fileContent);
        Storage::disk(config('filesystems.file_disk'))->assertExists($path . $filename);

        $response = $this->get(to()->web->file(new File([File::name => $filename])));

        $response->assertStatus(200);
        $response->assertHeader('Content-Type', $mimeType);
        $response->assertSee($fileContent);

        Storage::disk(config('filesystems.file_disk'))->delete($path . $filename);
    }

    /**
     * @test
     * @see FileServeResponse
     */
    public function returns_cached_response_when_available(): void
    {
        $filename = 'testfile.txt';
        // Mock a request object
        $this->get(to()->web->file(new File([File::name => $filename])));

        // Mock a cached response
        $cachedResponse = response('cached content', 200);

        // Set up the cache to return the cached response
        Cache::shouldReceive('rememberForever')
            ->once()
            ->with(to()->web->file(new File([File::name => $filename])), Closure::class)
            ->andReturn($cachedResponse);

        // Call the controller method
        $response = $this->get(to()->web->file(new File([File::name => $filename])));

        // Assert that the response is the cached response
        $response->assertStatus(200);
        $response->assertSeeText('cached content');
    }
}
