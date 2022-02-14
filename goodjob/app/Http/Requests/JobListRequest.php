<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class JobListRequest extends FormRequest
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
        // dd(request()->all());
        return [
            'name' => 'required',
            'description' => 'required',
            'date' => 'required',
            'from_time_hours' => 'required',
            'to_time_minutes' => 'required',
            'client_id' => 'required',
            'place_of_work' => 'required',
            'contact_person' => 'required',
            'phone' => 'required',
            'email' => 'required',
            'signature' => 'required',
        ];
    }

    public function messages(){
        return [

            'name.required' => __('messages.name_required'),
            'status.required' => __('messages.status_required'),
            'description.required' => __('messages.description_required'),
            'date.required' => __('messages.date_required'),
            'from_time_hours.required' => __('messages.from_time_hours_required'),
            'to_time_minutes.required' => __('messages.to_time_minutes_required'),
            'client_id.required' => __('messages.client_id_required'),
            'place_of_work.required' => __('messages.place_of_work_required'),
            'contact_person.required' => __('messages.contact_person_required'),
            'phone.required' => __('messages.phone_required'),
            'email.required' => __('messages.email_required'),
            'signature.required' => __('messages.signature_required'),
            
        ];
    }
}
