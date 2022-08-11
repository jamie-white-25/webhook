<?php

namespace Tests\Feature\Episodes;

use App\Models\Episode;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class StoreEpisodesTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Make sure an episode can be stored
     *
     * @return void
     */
    public function test_episodes_can_stored()
    {
        Episode::factory()->create();
        $this->assertDatabaseCount('episodes', 1);
    }
}
