<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GameUploadRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|max:64',
            'short_description' => 'max:128',
            'description' => 'required|min:64',
            'genre' => 'required',
            'tags' => 'required|array|max:10|min:1',
            'GameFile' => 'required',
            'screenshots' => 'required'
        ];
    }
}
