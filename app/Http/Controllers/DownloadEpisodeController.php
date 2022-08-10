<?php

namespace App\Http\Controllers;

use App\Models\Episode;
use Illuminate\Http\Request;

class DownloadEpisodeController extends Controller
{

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Episode $episode)
    {
        return $episode->events()
            ->where('type', 'episode.downloaded')
            ->where('occurred_at', '>', now()->subWeek())
            ->get();
    }
}
