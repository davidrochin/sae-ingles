<?php

namespace App\Http\Requests;

use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ModifyStudentRequest extends FormRequest
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
            //'controlNumber' => ['required', 'max:8']
            'controlNumber' => 'digits:8|unique:students,control_number,'.$this->input('id'),
            'careerId' => 'required',
            'firstNames' => 'required',
            'lastNames' => 'required',
            'phoneNumber' => 'digits_between:0,30',
            'email' => 'email',
        ];
    }

    public function messages(){
        return [
            'controlNumber.required' => 'No puede estar vacío.',
            'controlNumber.unique' => 'Ya existe un alumno con ese número de control.',
            'controlNumber.digits' => 'El número de control necesita tener 8 dígitos.',
            'firstNames.required' => 'Es necesario proporcionar un nombre.',
            'lastNames.required' => 'Es necesario proporcionar los apellidos.',
            'phoneNumber.digits_between' => 'Necesita ser un número de entre 0 y 30 dígitos.',
            'email.email' => 'No es un correo electrónico válido.'
        ];
    }
}
