<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        $when = Rule::when(!$this->isMethod('post'), 'nullable', 'required');

        return [
            'name' => [$when, 'string', 'max:255'],
            'username' => [$when, 'string', 'alpha_dash', 'max:30'],
            'email' => [$when, 'string', 'email', 'max:255', Rule::unique('users')->ignore(optional($this)->user)],
            'password' => [$when, 'string', 'min:8', 'confirmed'],
        ];
    }
}
