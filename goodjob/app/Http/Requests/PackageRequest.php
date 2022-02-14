<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PackageRequest extends FormRequest
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
            
            'title' => ['required', 'string'],
            'heading' => ['required', 'string'],
            'sub_heading' => ['required', 'string'],
            'package_name' => ['required', 'string'],
            'duration' => ['required'],
            // 'icon' => ['required'],
            'price' => ['required'],
            'manager' => ['required'],
            'users' => ['required'],
            'support_text' => ['required'],
            'storage_text' => ['required'],
            'currency' => ['required'],
            'package_type_text' => ['required'],
            'storage_place_size' => ['required'],
            'button_text' => ['required'],

        ];
    }

    public function messages(){
        return [
            
            'title.required' => __('messages.title_required'),
            'duration.required' => __('messages.duration_required'),
            'icon.required' => __('messages.icon_required'),
            'price.required' => __('messages.price_required'),
            'manager.required' => __('messages.manager_required'),
            'users.required' => __('messages.users_required'),
            'support_text.required' => __('messages.support_text_required'),
            'storage_text.required' => __('messages.storage_text_required'),

        ];
    }
}
