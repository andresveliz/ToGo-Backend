<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\CheckSamePassword;
use App\Rules\MatchOldPassword;

class ChangePasswordUserRequest extends FormRequest
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
            'current_password' => ['required', new MatchOldPassword],
            'password' => ['required', 'confirmed', 'min:8', new CheckSamePassword]
        ];

    }

    public function messages()
    {
        return [
            'current_password.required' => 'El campo Contraseña Actual es obligatorio',
            'password.required' => 'El campo Nueva Contraseña es obligatorio'
        ];
    }
}
