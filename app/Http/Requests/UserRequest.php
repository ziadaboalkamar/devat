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
        // $id = $this->route('id', 0);
        return [
            'firstname'=> ['required', 'string','max:100'],
            'lastname'=> ['required', 'string', 'max:100'],
            'jobName'=> ['required', 'string', 'max:100'],
            'phoneNumber'=> ['required','numeric','digits:10','unique:users,PhoneNumber,'],
            'email' => ['required', 'string','email','unique:users,email,'],
            'password' => ['required'],
            'userName'=> ['required','string','max:100','unique:users,userName,'],
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
            'numeric' => 'يجب ادخال في الارقام',
            'digits:10'=>'يجب ان يحتوي على 10 ارقام'
        ];
    }
}
