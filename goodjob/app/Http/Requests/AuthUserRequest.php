<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Password;

class AuthUserRequest extends FormRequest
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
            'first_name' => ['required', 'string'],
            'last_name' => ['required', 'string'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => [
                            'required',
                            'confirmed',
                            'min:8',
                            'max:20',
                            'regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[^\w\s]).{8,20}$/'
                        ],
        ];
    }

    public function messages()
    {
        return [

            'first_name.required' => __('messages.first_name_required'),
            'first_name.string' => __('messages.first_name_string'),
            'last_name.required' => __('messages.last_name_required'),
            'last_name.string' => __('messages.last_name_string'),
            'email.required' => __('messages.email_required'),
            'email.string' => __('messages.email_string'),
            'email.email' => __('messages.email_email'),
            'email.unique' => __('messages.email_unique'),
            'password.required' => __('messages.password_required'),
            'password.confirmed' => __('messages.password_confirmed'),
            'password.regex' => __('messages.password_regex'),
            'password.min' => __('messages.password_min'),
            'password.max' => __('messages.password_max'),        
        ];
    }
}
