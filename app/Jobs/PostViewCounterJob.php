<?php

namespace App\Jobs;

use App\Models\Post;
use App\Models\View;
use DB;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Throwable;

class PostViewCounterJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(public readonly Post $post, public readonly string $ip, public readonly string $agent)
    {
    }

    /**
     * @throws Throwable
     */
    public function handle(): void
    {
        DB::transaction(function () {
            $this->post->increment(Post::views);

            View::create([
                View::post_id => $this->post->id,
                View::ip => $this->ip,
                View::user_agent => $this->agent,
                View::locale => app()->getLocale(),
            ]);
        });
    }
}
