<?php

namespace App\Http\Controllers;

use App\Http\Resources\EventDownloadResource;
use App\Models\Episode;

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
        // number of days to be queried.
        $days = 7;

        // date to be filtered upto, E.g: last 7 days.
        $endDate = now()->subDays($days - 1);

        // Filter event data by type and end date;
        $data = $episode->events()
            ->filterType('episode.downloaded', $endDate)
            ->get();

        // Empty collect for the formated return dates.
        $downloadDates = collect();

        /**
         *  This should be move into a service to be reused.
         *  This loop is to push the date and count on the $data.
         *  The lopp will assign a count of 0 if the $data doesn't had the date.
         *
         *  Loop over the days until $i is greater then days
         *  The loop date is chcked to be on the dowloadDate and add the date to the downloadDates.
         *  If the $dowloadData has the $date then add the count to $data
         */
        for ($i = 0; $i <= $days - 1; $i++) {
            $date = now()->subDay($i)->toDateString();

            $count = $data->has($date)
                ? $data->where('date', $date)->pluck('count')[0]
                : 0;

            $downloadDates->push(['date' => $date, 'count' => $count]);
        }

        return EventDownloadResource::collection($downloadDates);
    }
}
