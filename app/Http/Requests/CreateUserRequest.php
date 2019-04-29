<?php

namespace App\Http\Requests;

use App\User;
use Illuminate\Support\Facades\Auth;
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

        //Revisar si el usuario es administrador o coordinador
        if(Auth::user()->hasAnyRole(['admin', 'coordinator'])){
            return true;
        } else {
            return false;
        }
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
            'password' => 'required|max:30|min:6',
            'roleId' => 'required',           
        ];
    }
    public function messages(){
        return [
            'name.required' => 'Es necesario proporcionar un nombre.',
            'email.unique' => 'Este correo electrónico ya existe.',
            'email.required' => 'Es necesario proporcionar un correo electrónico.',
            'email.email' => 'Debe ingresar un correo electrónico valido.',
            'password.max' => 'La contraseña solo puede contener 30 caracteres como máximo.',
            'password.min' => 'La contraseña debe ser mayor a 5 caracteres.',
            'password.required' => 'Es necesario ingresar una contraseña.',
            'roleId.required' => 'Es necesario seleccionar una carrera.',
        ];
    }
}
