<?php

namespace Tests\Feature\Events;

use App\Models\Event;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use Tests\TestCase;

class StoreEventTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Make sure an event can be stored
     *
     * @return void
     */
    public function test_events_can_stored()
    {
        Event::factory()->create();
        $this->assertDatabaseCount('events', 1);
    }

    // /**
    //  * Make sure an event can store a postcast relationship
    //  *
    //  * @return void
    //  */
    // public function test_events_can_stored_with_podcast_relationship()
    // {
    //     $event = Event::factory()
    //         ->hasPodcasts(3, [
    //             'uuid' => (string) Str::uuid()
    //         ])
    //         ->create();

    //     $this->assertDatabaseCount('events', 1);
    //     $this->assertDatabaseCount('podcasts', 3);
    // }

    // /**
    //  * Make sure an event can store a episode relationship
    //  *
    //  * @return void
    //  */
    // public function test_events_can_stored_with_episode_relationship()
    // {
    //     $event = Event::factory()
    //         ->hasEpisodes(3, [
    //             'uuid' => (string) Str::uuid()
    //         ])
    //         ->create();

    //     $this->assertDatabaseCount('events', 1);
    //     $this->assertDatabaseCount('episodes', 3);
    // }
}
