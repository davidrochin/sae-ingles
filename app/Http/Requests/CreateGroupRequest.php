<?php

namespace App\Http\Requests;

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
            'code' => 'required',
            'level' => 'required',
            'professorId' => 'required|exists:users,id',
            'scheduleStart' => 'required',
            'scheduleEnd' => 'required',
            'days' => 'required',
            'year' => 'required',
            'periodId' => 'required|exists:periods,id',
            'classroomId' => 'required|exists:classrooms,id',
        ];
    }

    public function messages(){
        return [
            'name.required' => 'No puede estar vacío.',
            'days.required' => 'Es necesario especificar al menos un día.',
            'code.required' => 'No puede estar vacío.',
            'level.required' => 'No puede estar vacío.',
            'scheduleStart.required' => 'No puede estar vacío.',
            'scheduleEnd.required' => 'No puede estar vacío.',
        ];
    }
}
