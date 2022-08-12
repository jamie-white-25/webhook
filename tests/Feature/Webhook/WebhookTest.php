<?php

namespace Tests\Feature\Webhook;

use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Queue;
use Illuminate\Support\Str;
use Tests\TestCase;

class WebhookTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Assert Webhook validation pass
     *
     * @return void
     */
    public function test_assert_webhook_validation_pass()
    {
        Queue::fake();

        $response = $this->postJson('/webhook', [
            'type' => 'episode.downloaded',
            'event_id' => (string) Str::uuid(),
            'occurred_at' => Carbon::now()->toIso8601String(),
            'data' => [
                'episode_id' => (string) Str::uuid(),
                'podcast_id' => (string) Str::uuid(),
            ],
        ]);

        $response->assertValid();
        $response->assertNoContent();
    }

    /**
     * Assert Webhook validation pass
     *
     * @return void
     */
    public function test_assert_webhook_validation_fail()
    {
        $response = $this->postJson('/webhook', [
            'type' => null,
            'event_id' => 1234,
            'occurred_at' => null,
            'data' => [
                'episode_id' => null,
                'podcast_id' => 1234,
            ],

        ]);

        $response->assertInvalid([
            'type' => 'The type field is required.',
            'event_id' => 'The event id must be a string.',
            'occurred_at' => 'The occurred at field is required.',
            'data.episode_id' => 'The data.episode id field is required.',
            'data.podcast_id' => 'The data.podcast id must be a string.',
        ]);
    }
}
