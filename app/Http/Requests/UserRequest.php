<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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

            'firstname'=> ['required', 'string','max:100'],
            'lastname'=> ['required', 'string', 'max:100'],
            'jobName'=> ['required', 'string', 'max:100'],
            'phoneNumber'=> ['required','numeric','Digits:10','unique:users,PhoneNumber,'.$this->id],
            'email' => ['required', 'string','email','unique:users,email,'.$this->id],
            'password' => ['required','Password'],
            'userName'=> ['required','string','max:100','unique:users,PhoneNumber,'.$this->id],
            'rolle_id' =>['required'],
            'branch_id' => ['required']

        ];
    }

    public function messages()
    {
        return [
            'required'=>"هذا الحقل مطلوب.",
            'string' =>'يجب ادخال في الاحراف.',
            'max'=>'هذا الحقل طويل للغاية.',
            'numeric' => 'يجب ادخال في الارقام'
        ];
    }
}
