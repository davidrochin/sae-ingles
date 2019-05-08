<?php

namespace App\Http\Requests;


use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class RegistryRequest extends FormRequest
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

            'controlNumber' => 'unique:students,control_number',
            'careerId' => 'sometimes|nullable|exists:careers,id',
            'firstNames' => 'required',
            'lastNames' => 'required',
            'phoneNumber' => 'sometimes|digits_between:0,30',
            'email' => 'required|email',
            'password' => 'required|max:30|min:6'
          //  'rpassword_confirmation' => 'required|max:30|min:6|same:rpassword'
         
        ];
    }
    public function messages(){
        return [

            'controlNumber.required' => 'No puede estar vacío.',
            'controlNumber.unique' => 'Ya existe un alumno con ese número de control.',
            'firstNames.required' => 'Es necesario proporcionar un nombre.',
            'lastNames.required' => 'Es necesario proporcionar los apellidos.',
            'phoneNumber.required' => 'Es necesario especificar un número de telefono.',
            'phoneNumber.digits_between' => 'Necesita ser un número de entre 0 y 30 dígitos.',
            'email.email' => 'No es un correo electrónico válido.',
            'email.required' => 'Es necesario un correo electrónico válido.',
            'password.required' => 'Es necesario proporcionar una contraseña.',
          /*  'rpassword_confirmation.required' => 'Es necesario confirmar la contraseña.',
            'rpassword_confirmation.same:rpassword' => 'No coincide.',*/
        ];
    }
}
