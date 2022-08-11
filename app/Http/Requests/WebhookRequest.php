<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WebhookRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'type' => [
                'required',
                'string',
                'max:255',
            ],
            'event_id' => [
                'required',
                'string',
                'max:255',
            ],
            'occurred_at' => [
                'required',
                'date',
            ],
            'data.episode_id' => [
                'required',
                'string',
                'max:255',
            ],
            'data.podcast_id' => [
                'required',
                'string',
                'max:255',
            ],
        ];
    }
}
