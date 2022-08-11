<?php

namespace App\Http\Controllers;

use App\Http\Resources\EpisodeResource;
use App\Models\Episode;
use Illuminate\Http\Resources\Json\JsonResource;

class EpisodeController extends Controller
{
    /**
     * Index episodes and paginate.
     *
     * @return JsonResource
     */
    public function index(): JsonResource
    {
        return  EpisodeResource::collection(Episode::paginate(10));
    }
}
