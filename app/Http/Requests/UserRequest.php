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
<<<<<<< HEAD
            'phoneNumber'=> ['required','numeric','unique:users,PhoneNumber,'.$this->id],
            'email' => ['required', 'string', 'email','unique:users,email,'.$this->id],
            'password' => ['required', 'string',' regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[!$#%]).*$/'],
=======
            'phoneNumber'=> ['required','numeric'],
            'email' => ['required','string','email'],
            'password' => ['required', 'string'],
>>>>>>> c63df5b2e3f86128507309599867491e10f9e66e
            'userName'=> ['required', 'string', 'max:100']

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
