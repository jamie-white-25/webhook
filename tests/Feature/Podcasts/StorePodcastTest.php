<?php

namespace Tests\Feature\Podcasts;

use App\Models\Podcast;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class StorePodcastTest extends TestCase
{
    /**
     * Make sure an podcast can be stored
     *
     * @return void
     */
    public function test_podcasts_can_stored()
    {
        Podcast::factory()->create();
        $this->assertDatabaseCount('podcasts', 1);
    }
}
