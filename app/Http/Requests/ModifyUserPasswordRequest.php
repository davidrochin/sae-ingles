<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ModifyUserPasswordRequest extends FormRequest
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
            'newPassword' => 'required|min:6|max:30'
        ];
    }
    public function messages(){
        return [
            'newPassword.required' => 'No puede dejar este campo vacío.',
            'newPassword.min' => 'La nueva contraseña debe ser mayor a 5 caracteres.',
            'newPassword.max' => 'La nueva contraseña solo puede contener 30 caracteres como máximo.',
        ];
    }
}
