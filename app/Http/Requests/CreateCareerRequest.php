<?php

namespace App\Http\Requests;

use App\Career;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class CreateCareerRequest extends FormRequest
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
            'short_name' => 'required',
            
        ];
    }

    public function messages(){
        return [
            'name.required' => 'No puede estar vacío.',
            'short_name.required' => 'No puede estar vacío.'
          
        ];
    }
}
