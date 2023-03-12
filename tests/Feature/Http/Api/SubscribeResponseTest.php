<?php

namespace Tests\Feature\Http\Api;

use App\Helpers\ApiRoutes;
use App\Helpers\CacheKeys;
use App\Http\Controllers\Api\SubscribeResponse;
use App\Mail\EmailSubscription;
use App\Models\Contact;
use App\Services\Newsletter\Support\MailchimpSubscriber;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Mail;
use MailchimpMarketing\ApiClient;
use Mockery;
use Mockery\LegacyMockInterface;
use Mockery\MockInterface;
use Tests\TestCase;

class SubscribeResponseTest extends TestCase
{
    use RefreshDatabase;

    protected array $headers;
    protected LegacyMockInterface|MockInterface $mailchimp;

    protected function setUp(): void
    {
        parent::setUp();

        $this->headers = [
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . user()->createToken(CacheKeys::newsletter->value)->plainTextToken,
        ];

        Mail::fake();

        $mockApiClient = Mockery::mock(ApiClient::class);
        $this->mailchimp = $mockApiClient->lists = Mockery::mock();

        $this->app->instance(ApiClient::class, $mockApiClient);
    }

    protected function tearDown(): void
    {
        parent::tearDown();
        Mockery::close();
    }

    /**
     * @test
     *
     * @see SubscribeResponse
     */
    public function subscribe(): void
    {
        $email = 'valid@gmail.com';
        $this->mailchimp->shouldReceive('addListMember')
            ->withArgs([
                config('mail.mailchimp.list_id'),
                (new MailchimpSubscriber($email))->toArray(),
            ])->once();
        $data = [SubscribeResponse::email => $email];

        $this->postAs(ApiRoutes::subscribe, $data, $this->headers)
            ->assertOk()
            ->assertJson(SubscribeResponse::response_success);
        Mail::assertQueued(EmailSubscription::class, 1);
        self::assertTrue(Contact::where(Contact::email, $email)->exists());
    }

    /**
     * @test
     *
     * @see SubscribeResponse
     */
    public function invalid_email(): void
    {
        $data = [SubscribeResponse::email => 'bogus email'];

        $this->postAs(ApiRoutes::subscribe, $data, $this->headers)
            ->assertJsonValidationErrorFor(SubscribeResponse::email)
            ->assertUnprocessable();
    }

    /**
     * @test
     *
     * @see SubscribeResponse
     */
    public function mailchimp_failed(): void
    {
        $email = 'valid@gmail.com';
        $this->mailchimp->shouldReceive('addListMember')
            ->once()
            ->andThrow(new ClientException('Mailchimp error', new Request('Post', route(ApiRoutes::subscribe->name)), new Response()));
        $data = [SubscribeResponse::email => $email];

        $this->postAs(ApiRoutes::subscribe, $data, $this->headers)
            ->assertStatus(500)
            ->assertJson(['message' => 'Mailchimp error']);
        Mail::assertQueued(EmailSubscription::class, 0);
        self::assertFalse(Contact::where(Contact::email, $email)->exists());
    }
}
