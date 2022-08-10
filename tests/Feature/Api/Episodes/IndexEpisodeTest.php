<?php

namespace Tests\Feature\Api\Episodes;

use App\Models\Episode;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class IndexEpisodeTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Get episodes from the index method
     *
     * @return void
     */
    public function test_get_episodes_from_index()
    {
        Episode::factory(10)->create();

        $response = $this->getJson('/api/episodes');

        $response->assertJsonStructure(
            [
                'data' => [
                    "*" => [
                        'name',
                        'uuid'
                    ]
                ]
            ]
        );
        $response->assertJsonCount(10, "data");
        $response->assertStatus(200);
    }

    /**
     * Get episodes from the index method and check is paginated
     *
     * @return void
     */
    public function test_assert_index_is_paginated()
    {
        Episode::factory(20)->create();

        $response = $this->getJson('/api/episodes');

        $response->assertJsonStructure(
            [
                'data' => [
                    "*" => [
                        'name',
                        'uuid'
                    ]
                ]
            ]
        );

        $response->assertJsonStructure([
            'meta',
            'links',
            'data'
        ]);

        $response->assertJsonCount(10, "data");
        $response->assertStatus(200);
    }
}
