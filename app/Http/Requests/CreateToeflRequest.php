<?php

namespace App\Http\Requests;


use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class CreateToeflRequest extends FormRequest
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

            'date' => 'required',
            'time' => 'required',
            'aplicadorId' => 'required|exists:users,id',
            'responsableId' => 'required|exists:users,id',
            'capacity' => 'required',
            'classroomId' => 'required|nullable|exists:classrooms,id'
          
         
        ];
    }
    public function messages(){
        return [

            'date.required' => 'No puede estar vacío.',
            'time.required' => 'Es necesario especificar al menos un día.',
            'aplicadorId.exists' => 'Ese profesor no existe.',
            'aplicadorId.required' => 'Asigna a un aplicador.',
            'responsableId.exists' => 'Ese profesor no existe.',
            'responsableId.required' => 'Asigna a un responsable.',
            'classroomId.exists' => 'Esa aula no existe.',
            'classroomId.required' => 'Asigna un aula.',
            'capacity.required' => 'No puede estar vacío.'
          
        ];
    }
}
