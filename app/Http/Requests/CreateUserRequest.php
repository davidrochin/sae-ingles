<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateUserRequest extends FormRequest
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
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'roleId' => 'required',            
        ];
    }
    public function messages(){
        return [
            'name.required' => 'Es necesario proporcionar un nombre.',
            'email.unique' => 'No puede estar vacío.',
            'password.digits' => 'No puede estar vacío.',
            'roleId.required' => 'No puede estar vacío.',
        ];
    }
}
