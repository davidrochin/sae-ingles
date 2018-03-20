<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddStudentToGroupRequest extends FormRequest
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
            'groupId' => 'required|exists:groups,id',
            'studentId' => 'required|exists:students,id',
        ];
    }

    public function messages(){
        return [
            'groupId.required' => 'Es necesario especificar el grupo al cual se añadirá el alumno.',
            'groupId.exists' => 'No existe un grupo con ese ID.',
            'studentId.required' => 'Es necesario especificar el alumno a añadir.',
            'studentId.exists' => 'No existe un alumno con ese ID.',
        ];
    }
}
