<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileRequest extends FormRequest
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
                'username' => 'required',
                'first_name' => 'required',
                'last_name' => 'required',
                'private_address' => 'required',
                'house_no' => 'required',
                'zip_code' => 'required',
                'city' => 'required',
                'country' => 'required',
                'phone' => 'required',
                'mobile' => 'required'
        ];

    }

    public function messages()
    {
        return [
            'username.required' => __('messages.username_required'),
            'first_name.required' => __('messages.first_name_required'),
            'last_name.required' => __('messages.last_name_required'),
            'private_address.required' => __('messages.private_address_required'),
            'house_no.required' => __('messages.house_no_required'),
            'zip_code.required' => __('messages.zip_code_required'),
            'city.required' => __('messages.city_required'),
            'country.required' => __('messages.country_required'),
            'phone.required' => __('messages.phone_required'),
            'mobile.required' => __('messages.mobile_required'),
        ];
    }
}
