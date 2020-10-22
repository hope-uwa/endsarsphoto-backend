<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreatePostPicturesRequest extends FormRequest
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
            'state_id' => 'required|exists:states,id',
            'event_date' => 'required|date_format:Y-m-d',
            'event_time' => 'required|date_format:H:i',
            'location' => 'required|string|min:3|max:60',
            'description' => 'required|string|min:3|max:255',
            'note' => 'required|string|min:3|max:5000',
            'photos' => 'required|array',
            'photos.*.image' => 'required|file'
        ];
    }
}
