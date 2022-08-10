<?php

namespace App\Http\Controllers;

use App\Http\Requests\WebhookRequest;
use App\Jobs\StoreWebhookData;
use App\Models\Event;
use Illuminate\Http\Request;

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
        StoreWebhookData::dispatch($request->validated());

        return response()->noContent();
    }
}
