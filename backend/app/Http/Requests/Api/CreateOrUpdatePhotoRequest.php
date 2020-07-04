<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class CreateOrUpdatePhotoRequest extends FormRequest
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
            'id' => ['required', 'numeric'],
            'title' => ['required', 'max:100'],
            'description' => ['required', 'max:1000'],
            'img' => ['required'],
            'date' => ['required', 'date'],
            'featured' => ['required', 'boolean'],
            'gallery_id' => ['required', 'exists:galleries,id'],
        ];
    }
}
