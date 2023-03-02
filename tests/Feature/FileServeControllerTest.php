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
        $filename = 'test.txt';
        $path = config('filesystems.disks.s3.bucket_path');
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
    public function returns_cached_response_when_available(): void
    {
        $filename = 'testfile.txt';
        // Mock a request object
        $this->getAs(Routes::file, [$filename]);

        // Mock a cached response
        $cachedResponse = response('cached content', 200);

        // Set up the cache to return the cached response
        Cache::shouldReceive('remember')
            ->once()
            ->with(route_as(Routes::file, [$filename]), null, Closure::class)
            ->andReturn($cachedResponse);

        // Call the controller method
        $response = $this->getAs(Routes::file, [$filename]);

        // Assert that the response is the cached response
        $response->assertStatus(200);
        $response->assertSeeText('cached content');
    }
}
