<?php

namespace App\Http\Requests;

use App\User;
use Illuminate\Support\Facades\Auth;
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
        $user = Auth::user();
        $userToModify = User::find($this->input('id'));
        //dd($this);

        if($user->isSuperiorThan($userToModify)){
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
            'id' => 'required|exists:users',
            'newPassword' => 'required|min:6|max:30'
        ];
    }
    public function messages(){
        return [
            'id.required' => 'No se ha mandado usuario.',
            'newPassword.required' => 'No puede dejar la contraseña vacía.',
            'newPassword.min' => 'La nueva contraseña debe ser mayor a 5 caracteres.',
            'newPassword.max' => 'La nueva contraseña solo puede contener 30 caracteres como máximo.',
        ];
    }
}
