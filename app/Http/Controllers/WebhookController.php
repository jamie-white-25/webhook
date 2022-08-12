<?php

namespace App\Http\Controllers;

use App\Http\Requests\WebhookRequest;
use App\Models\Episode;
use App\Models\Event;
use App\Models\Podcast;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class WebhookController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  WebhookRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(WebhookRequest $request)
    {
        $episode = Episode::firstOrCreate(['uuid' => $request->data['episode_id']]);
        $podcast = Podcast::firstOrCreate(['uuid' => $request->data['podcast_id']]);

        $event = Event::firstOrCreate(
            [
                'event_id' => $request->event_id,
            ],
            [
                'type' => $request->type,
                'occurred_at' => Carbon::parse($request->occurred_at)->setTimezone('UTC')->format('Y-m-d H:i:s'),
            ]
        );

        $event->episodes()->attach($episode);
        $event->podcasts()->attach($podcast);

        return response()->noContent();
    }
}
