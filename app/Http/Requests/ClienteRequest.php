<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClienteRequest extends FormRequest
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
                    //'ci' => 'required|string|min:1',
                    'nit' => 'required|string|min:1',
                    'tipo' => 'required',
                    //'user_id' => 'required|integer',
                ];
            break;
            default:
                $rules = [
                    'ci' => 'required|string|min:1',
                    'nit' => 'required|string|min:1',
                    'tipo' => 'required',
                    //'user_id' => 'required|integer',
                ];
            break;
        }
        return $rules;
    }
}
