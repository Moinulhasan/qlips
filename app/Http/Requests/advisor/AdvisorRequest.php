<?php

namespace App\Http\Requests\advisor;

use Illuminate\Foundation\Http\FormRequest;

class AdvisorRequest extends FormRequest
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
            'name'=>'required|string',
            'profession'=>'required|string',
            'image'=>'required|mimes:jpg,jpeg,png,svg,gif|max:5000',
        ];
    }
}
