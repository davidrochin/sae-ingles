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

            'controlNumber' => 'required|unique:students,control_number',
            'careerControlInput' => 'required|nullable|exists:careers,id',
            'firstNames' => 'required',
            'lastNames1' => 'required',
            'lastNames2' => 'required',
            'email' => 'required|email',
            'password' => 'required|max:30|min:6'
          //  'rpassword_confirmation' => 'required|max:30|min:6|same:rpassword'
         
        ];
    }
    public function messages(){
        return [

            'controlNumber.required' => 'Proporciona un número de control.',
            'controlNumber.unique' => 'Ya existe un alumno con ese número de control.',
            'careerControlInput.required' => 'Selecciona una carrera.',
            'firstNames.required' => 'Es necesario proporcionar un nombre.',
            'lastNames1.required' => 'Es necesario proporcionar apellido paterno.',
            'lastNames2.required' => 'Es necesario proporcionar apellido materno.',
            'phoneNumber.digits_between' => 'Necesita ser un número de entre 0 y 30 dígitos.',
            'email.email' => 'No es un correo electrónico válido.',
            'email.required' => 'Es necesario un correo electrónico válido.',
            'password.required' => 'Es necesario proporcionar una contraseña.',
          /*  'rpassword_confirmation.required' => 'Es necesario confirmar la contraseña.',
            'rpassword_confirmation.same:rpassword' => 'No coincide.',*/
        ];
    }
}
