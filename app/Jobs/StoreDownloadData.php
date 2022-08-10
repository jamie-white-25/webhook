<?php

namespace App\Jobs;

use App\Models\Event;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Carbon;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class StoreDownloadData implements ShouldQueue
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
    public function handle(Event $event)
    {
        Event::create(
            [
                'type' => $this->data['type'],
                'event_id' => $this->data['event_id'],
                'occurred_at' => Carbon::parse($this->data['occurred_at'])->setTimezone('UTC')->format('Y-m-d H:i:s'),
                'episode_uuid' => $this->data['data']['episode_id'],
                'podcast_uuid' => $this->data['data']['podcast_id']
            ]
        );
    }
}
