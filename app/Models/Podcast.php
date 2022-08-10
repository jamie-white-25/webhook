<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Podcast extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'uuid'];

    /**
     * Get all events of the podcast
     */
    public function events()
    {
        return $this->morphToMany(Event::class, 'eventable');
    }
}
