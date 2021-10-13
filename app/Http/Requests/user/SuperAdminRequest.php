<?php

namespace App\Http\Requests\user;

use Illuminate\Foundation\Http\FormRequest;

class SuperAdminRequest extends FormRequest
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
            'email'=>'required|email|unique:users,email',
            'phone'=>'required|numeric|unique:users,phone',
            'password'=>'required|string|min:6',
            'image'=>'required|mimes:jpeg,jpg,png,gif|max:5000',
            'role_id'=>'required|integer'
        ];
    }
}
