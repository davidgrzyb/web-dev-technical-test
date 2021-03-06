<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class CreatePhotographerRequest extends FormRequest
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
            'name' => ['required', 'max:255'],
            'phone' => ['required', 'max:15'],
            'email' => ['required', 'unique:photographers,email', 'email', 'max:255'],
            'bio' => ['required', 'max:1000'],
            'profile_picture' => ['required'],
            'album' => ['required'],
            'album.*.id' => ['required', 'numeric'],
            'album.*.title' => ['required', 'max:100'],
            'album.*.description' => ['required', 'max:1000'],
            'album.*.img' => ['required'],
            'album.*.date' => ['required', 'date'],
            'album.*.featured' => ['required', 'boolean'],
        ];
    }
}
