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

    /**
     * Scope a query to only include popular users.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeFilterType($query, string $event = '', string $date = '')
    {
        $query->when($event ?? null, function ($query) {
            $query->where('type', 'episode.downloaded');
        });

        $query->when($date ?? null, function ($query, $date) {
            $query->where('occurred_at', '>', $date)
                ->selectRaw('Date(occurred_at) as occurred_date')
                ->orderBy('occurred_date', 'desc')
                ->get()
                ->map(function ($item) {
                    return  ['date' => $item->first()->occurred_date, 'count' => $item->count()];
                });
        });

        return $query;
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
