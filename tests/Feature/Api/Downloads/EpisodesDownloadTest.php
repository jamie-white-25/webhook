<?php

namespace Tests\Feature\Api\Downloads;

use App\Models\Episode;
use App\Models\Event;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EpisodesDownloadTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Assert route exists
     *
     * @return void
     */
    public function test_assert_route_exists()
    {
        $episode = Episode::factory()->create();

        $response = $this->getJson("/api/downloads/episodes/$episode->uuid");

        $this->assertDatabaseCount('episodes', 1);
        $response->assertOk();
    }

    /**
     * Assert json structure is correct
     *
     * @return void
     */
    public function test_assert_episdoe_downlaod_json_structure_is_correct()
    {
        $episode = Episode::factory()
            ->hasAttached(Event::factory()->count(100))
            ->create();

        $response = $this->getJson("/api/downloads/episodes/$episode->uuid");

        $this->assertDatabaseCount('episodes', 1);
        $this->assertDatabaseCount('events', 100);
        $response->assertOk();
        $response->assertJsonStructure([
            'data' => [
                '*' => [
                    'date',
                    'count',
                ],
            ],
        ]);
    }

    /**
     * Assert json is correct
     *
     * @return void
     */
    public function test_assert_episdoe_downlaod_json_is_correct()
    {
        $episode = Episode::factory()
            ->hasAttached(Event::factory()->count(10))
            ->create();

        $response = $this->getJson("/api/downloads/episodes/$episode->uuid");

        $response->assertOk();
        $response->assertJsonCount(7, 'data');
        $response->assertJsonFragment(['date' => now()->toDateString()]);
    }
}
