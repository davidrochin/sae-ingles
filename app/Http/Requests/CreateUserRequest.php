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
            'email' => 'unique:users,email|email',
            'password' => 'required|max:30',
            'roleId' => 'required',            
        ];
    }
    public function messages(){
        return [
            'name.required' => 'Es necesario proporcionar un nombre.',
            'email.unique' => 'Este correo electronico ya existe.',
            'email.required' => 'No puede estar vacio',
            'password.digits' => 'Solo puede contener 30 dígitos maximo.',
            'roleId.required' => 'No puede estar vacío.',
        ];
    }
}
