<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RepartidorRequest extends FormRequest
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
                ];
            break;
            case 'PATCH':
                $rules = [
                    'ubicacion.latitude' => 'required|numeric|min:-90|max:90',
                    'ubicacion.longitude' => 'required|numeric|min:-180|max:180',
                ];
            break;
            default:
                $rules = [
                    'nombre' => 'required|string|min:1',
                    'apellidos' => 'required|string|min:1',
                    'email' => 'required|string|email|max:150|unique:users,email',
                    'password' => 'required|string|min:8|confirmed',
                ];
            break;
        }

        return $rules;
    }
}
