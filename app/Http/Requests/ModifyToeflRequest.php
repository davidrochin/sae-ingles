<?php

namespace App\Http\Requests;

use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class ModifyToeflRequest extends FormRequest
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
            //
            'date' => 'required',
            'time' => 'required',
            'capacity' => 'required',
            'responsableId' => 'sometimes|nullable|exists:users,id',
            'applicatorId' => 'sometimes|nullable|exists:users,id',
            
        ];
    }

    public function messages(){
        return [
            'date.required' => 'No puede estar vacío.',
            'time.required' => 'No puede estar vacío.',
            'capacity.required' => 'No puede estar vacío.',
            'responsableId.required' => 'No puede estar vacío.',
            'applicatorId.required' => 'No puede estar vacío.',
        ];
    }
}
