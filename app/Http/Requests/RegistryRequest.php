<?php

namespace App\Http\Requests;

use App\User;
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
            'rpassword' => 'required|max:30|min:6',
            'rpassword_confirmation' => 'required|max:30|min:6|same:rpassword'
         
        ];
    }
    public function messages(){
        return [
            'rpassword.required' => 'Es necesario proporcionar una contraseña.',
           'rpassword_confirmation.required' => 'No coincide con la contraseña.',
        ];
    }
}
