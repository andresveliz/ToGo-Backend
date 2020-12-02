<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UsuarioRequest extends FormRequest
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
        switch($this->method()){
            case 'PUT':
                $rules = [
                    'nombre' => 'required|string|min:1',
                    'apellidos' => 'required|string|min:1',
                    'email' => 'required|string|email|max:150|unique:users,id,:id',
                    'telefono' => 'required|min:1',
                    // 'roles' => 'required',
                ];
            break;
            default:
                $rules = [
                    'nombre' => 'required|string|min:1',
                    'apellidos' => 'required|string|min:1',
                    'email' => 'required|string|email|max:150|unique:users',
                    'telefono' => 'required|min:1',
                    'password' => 'required|string|min:8|confirmed',
                    'roles' => 'required',
                ];
            break;
        }

        return $rules;

    }
}
