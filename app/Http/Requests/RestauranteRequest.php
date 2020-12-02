<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RestauranteRequest extends FormRequest
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
                    'direccion' => 'required|string|min:1',
                    'telefono' => 'required|min:1',
                    'logo' => 'image',
                    'email' => 'required|email|unique:restaurantes,id,:id',
                    'ubicacion.latitude' => 'numeric|min:-90|max:90',
                    'ubicacion.longitude' => 'numeric|min:-180|max:180',
                    'categorias' => 'required',
                ];
            break;
            case 'PATCH':
                $rules = [
                    'estado' => 'required',
                ];
            break;
            default:
                $rules = [
                    'nombre' => 'required|string|min:1',
                    'direccion' => 'required|string|min:1',
                    'telefono' => 'required|min:1',
                    'logo' => 'image',
                    'email' => 'required|email|unique:restaurantes,id,:id',
                    'ubicacion.latitude' => 'numeric|min:-90|max:90',
                    'ubicacion.longitude' => 'numeric|min:-180|max:180',
                    'categorias' => 'required',
                ];
            break;
        }

        return $rules;

    }

    public function messages()
    {
        return [
            'categorias.required' => 'Debe seleccionar por lo menos una categoria a la que pertenece'
        ];
    }
}
