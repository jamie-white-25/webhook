<?php

namespace Tests\Feature\Queue;

use Tests\TestCase;
use Illuminate\Support\Str;
use App\Jobs\StoreWebhookData;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Queue;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class StoreWebhookDataTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Check the queue is pushed.
     *
     * @return void
     */
    public function test_store_webhook_data_queue()
    {
        Queue::fake();

        $data =  [
            'type' => 'episode.downloaded',
            'event_id' => (string) Str::uuid(),
            'occurred_at' => Carbon::now()->toIso8601String(),
            'data' => [
                'episode_id' => (string) Str::uuid(),
                'podcast_id' => (string) Str::uuid(),
            ]
        ];

        StoreWebhookData::dispatch($data);

        Queue::assertPushed(StoreWebhookData::class);

        Queue::assertPushed(function (StoreWebhookData $job) use ($data) {
            return $job->data === $data;
        });
    }
}
