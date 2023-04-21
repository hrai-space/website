<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DigitalOceanStoreRequest extends FormRequest
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
            'GameFile' => 'sometimes',
            'GameFile.*' => 'sometimes|file|mimes:zip|max:1048576', //1gb
            'ImageFile' => 'sometimes',
            'ImageFile.*' => 'sometimes|image|max:2048',
        ];
    }
}