<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PlaceRequest extends FormRequest
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
            'job_title' => 'required',
            'distance' => 'required',
            'client_id' => 'required',
            'description' => 'required',
            'scheduled' => 'required',
            'assign_to' => 'required',
            'status' => 'required',
        ];
    }

    public function messages(){
        return [
            
            'job_title.required' => __('messages.job_title_required'),
            'distance.required' => __('messages.distance_required'),
            'client_id.required' => __('messages.client_id_required'),
            'description.required' => __('messages.description_required'),
            'scheduled.required' => __('messages.scheduled_required'),
            'assign_to.required' => __('messages.assign_to_required'),
            'status.required' => __('messages.status_required'),

        ];
    }
}
