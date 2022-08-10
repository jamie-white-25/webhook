<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['type', 'event_id', 'occurred_at', 'episode_uuid', 'podcast_uuid'];

    /**
     * Get eventable episodes.
     */
    public function episodes()
    {
        return $this->morphedByMany(Episode::class, 'eventable');
    }

    /**
     *  Get eventable podcasts.
     */
    public function podcasts()
    {
        return $this->morphedByMany(Podcast::class, 'eventable');
    }

    // /**
    //  * Get the podecast for the event.
    //  */
    // public function podcasts()
    // {
    //     return $this->hasMany(Podcast::class, 'uuid', 'podcast_uuid');
    // }

    // /**
    //  * Get the podecast for the event.
    //  */
    // public function episodes()
    // {
    //     return $this->hasMany(Episode::class, 'uuid', 'episode_uuid');
    // }
}
