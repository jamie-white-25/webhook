<?php

namespace Tests\Feature\Api\Downloads;

use Tests\TestCase;
use App\Models\Event;
use App\Models\Episode;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ShowEpisodesDownloadTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_get_episode()
    {
        $episode = Episode::factory()
            ->hasAttached(Event::factory()->count(50))
            ->create();

        $response = $this->getJson("/api/download/episodes/$episode->uuid");

        dd($response);

        $response->assertStatus(200);
    }
}
