<?php

namespace App\Jobs;

use App\Models\Episode;
use App\Models\Event;
use App\Models\Podcast;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Carbon;

class StoreWebhookData implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(public array $data)
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(Event $event, Podcast $podcast, Episode $episode)
    {
        $episode->findOrCreate(['uuid' => $this->data['episode_id']]);
        $podcast->findOrCreate(['uuid' => $this->data['podcast_id']]);

        $event = Event::findOrCreate(
            [
                'event_id' => $this->data['event_id']
            ],
            [
                'type' => $this->data['type'],
                'occurred_at' => Carbon::parse($this->data['occurred_at'])->setTimezone('UTC')->format('Y-m-d H:i:s'),
            ]
        );

        $event->episodes()->attach($episode);
        $event->podcasts()->attach($podcast);
    }
}
