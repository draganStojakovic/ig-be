<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
            'fname' => 'required',
            'lname' => 'required',
            'email' => 'unique:users|required|email:rfc,dns',
            'password' => [
                'required',
                'string',
                'min:8',             
                'regex:/[0-9]/',      
            ],
            'terms' => 'required'
        ];
    }
}
