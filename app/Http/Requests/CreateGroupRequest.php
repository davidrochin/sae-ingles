<?php

namespace App\Http\Requests;

use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class CreateGroupRequest extends FormRequest
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
            'code' => 'required',
            'level' => 'required',
            'professorId' => 'required|nullable|exists:users,id',
            'scheduleStart' => 'required',
            'scheduleEnd' => 'required',
            'days' => 'required',
            'year' => 'required',
            'periodId' => 'required|exists:periods,id',
            'classroomId' => 'required|nullable|exists:classrooms,id',
        ];
    }

    public function messages(){
        return [
            'name.required' => 'No puede estar vacío.',
            'days.required' => 'Es necesario especificar al menos un día.',
            'code.required' => 'No puede estar vacío.',
            'level.required' => 'No puede estar vacío.',
            'professorId.exists' => 'Ese profesor no existe.',
            'professorId.required' => 'Asigna a un profesor.',
            'classroomId.exists' => 'Esa aula no existe.',
            'classroomId.required' => 'Asigna un aula.',
            'scheduleStart.required' => 'No puede estar vacío.',
            'scheduleEnd.required' => 'No puede estar vacío.',
        ];
    }
}
