<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateStudentRequest extends FormRequest
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
            //'controlNumber' => ['required', 'max:8']
            'controlNumber' => 'unique:students,control_number|digits:8',
            'career' => 'required',
            'firstNames' => 'required|alpha',
            'fathersLastName' => 'required|alpha',
            'mothersLastName' => 'required|alpha',
            'phoneNumber' => 'required|digits_between:0,30',
            'email' => 'required|email',
        ];
    }

    public function messages(){
        return [
            'controlNumber.required' => 'No puede estar vacío.',
            'controlNumber.unique' => 'Ya existe un alumno con ese número de control.',
            'controlNumber.digits' => 'El número de control necesita tener 8 dígitos.'
        ];
    }
}
