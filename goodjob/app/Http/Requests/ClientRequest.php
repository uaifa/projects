<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClientRequest extends FormRequest
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
            'company' => ['required', 'string'],
            // 'first_name' => ['required', 'string'],
            // 'last_name' => ['required', 'string'],
            // 'email' => ['required', 'email'],
            // 'street' => ['required'],
            'house_no' => ['required'],
            'zip_code' => ['required'],
            // 'town' => ['required'],
            // 'telephone' => ['required'],
            // 'branch' => ['required'],
            // 'status' => ['required'],
        ];
    }

    public function messages(){
        return [
            
            'company.required' => __('messages.company'),
            'first_name.required' => __('messages.first_name_required'),
            'first_name.string' => __('messages.first_name_string'),
            'last_name.required' => __('messages.last_name_required'),
            'last_name.string' => __('messages.last_name_string'),
            'email.required' => __('messages.email_required'),
            'email.email' => __('messages.email_email'),
            'street.required' => __('messages.street_required'),
            'house_no.required' => __('messages.house_no_required'),
            'zip_code.required' => __('messages.zip_code_required'),
            'town.required' => __('messages.town_required'),
            // 'telephone.required' => __('messages.telephone_required'),
            // 'branch.required' => __('messages.branch_required'),
            // 'status.required' => __('messages.status'),

        ];
    }
}
