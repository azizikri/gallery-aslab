<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        $when = Rule::when(!$this->isMethod('post'), 'nullable', 'required');

        return [
            'image' => [$when, 'image', 'mimes:png,jpg,webp,jpeg'],
            'tags' => ['nullable', 'array'],
            'tags.*' => ['string'],
            'caption' => ['nullable', 'string', 'max:255'],
        ];
    }
}
