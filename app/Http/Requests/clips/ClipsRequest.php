<?php

namespace App\Http\Requests\clips;

use Illuminate\Foundation\Http\FormRequest;

class ClipsRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'question'=>'required|integer',
            'advisor'=>'required|integer',
            'upvote'=>'required|integer',
            'listening'=>'required|integer',
            'url'=>'required|string',
            'audio'=>'required|max:20000|mimes:audio/mpeg,mpga,mp3,wav',
        ];
    }
}
