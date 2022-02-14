<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StaffMemberRequest extends FormRequest
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
            'email' => (isset(request()->staff_member_id) && !empty(request()->staff_member_id)) ?  'required|email' : 'required|email|unique:users',//
            // 'password' => (isset(request()->staff_member_id) && !empty(request()->staff_member_id)) ? ['nullable'] : ['required', 'string', 'min:8'],
            'phone_number' => ['required'],
            'mobile_number' => ['required']
        ];
    }

    public function messages(){
        return [
            'first_name.required' => __('messages.first_name'),
            'first_name_string.required' => __('messages.first_name_string'),
            'last_name.required' => __('messages.last_name'),
            'last_name_string.required' => __('messages.last_name_string'),
            'email.required' => __('messages.email_required'),
            'email.email' => __('messages.email_email'),
            'email.unique' => __('messages.email_unique'),
            // 'password.required' => __('messages.password_required'),
            'phone_number.required' => __('messages.phone_number_required'),
            'mobile_number.required' => __('messages.mobile_number_required')

        ];
    }
}
