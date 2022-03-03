<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BeneficiaryRequest extends FormRequest
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
        switch ($this->method()) {
            case 'POST':
            {
                return [
                    'firstName' => 'required|regex:/^[A-Za-z0-9-أ-ي-pL\s\-]+$/u',
                    'secondName' => 'required|regex:/^[A-Za-z0-9-أ-ي-pL\s\-]+$/u',
                    'thirdName' => 'required|regex:/^[A-Za-z0-9-أ-ي-pL\s\-]+$/u',
                    'lastName' => 'required|regex:/^[A-Za-z0-9-أ-ي-pL\s\-]+$/u',
                    'gender' => 'required|regex:/^[A-Za-z0-9-أ-ي-pL\s\-]+$/u',
                    'id_number' => 'required|digits:9|numeric|unique:beneficiaries|numeric',
                    'PhoneNumber' => 'required|numeric|digits:10|unique:beneficiaries',
                    'family_member' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/',
                    'city_id' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/',
                    'address' => 'required|regex:/^[A-Za-z0-9-أ-ي-pL\s\-]+$/u',
                    'maritial' => 'required|regex:/^[A-Za-z0-9-أ-ي-pL\s\-]+$/u',
                ];
            }
            case 'PUT':
            case 'PATCH':
            {
                return [
                    'firstName' => 'required|regex:/^[A-Za-z0-9-أ-ي-pL\s\-]+$/u',
                    'secondName' => 'required|regex:/^[A-Za-z0-9-أ-ي-pL\s\-]+$/u',
                    'thirdName' => 'required|regex:/^[A-Za-z0-9-أ-ي-pL\s\-]+$/u',
                    'lastName' => 'required|regex:/^[A-Za-z0-9-أ-ي-pL\s\-]+$/u',
                    'gender' => 'required',
                    'id_number' => 'required|digits:9|numeric|unique:beneficiaries,id_number,'.$this->route()->beneficiarei->id,
                    'PhoneNumber' => 'required|digits:10|numeric|unique:beneficiaries,PhoneNumber,'.$this->route()->beneficiarei->id,
                    'family_member' => 'required|numeric',
                    'city_id' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/',
                    'address' => 'required|regex:/^[A-Za-z0-9-أ-ي-pL\s\-]+$/u',
                    'maritial' => 'required|regex:/^[A-Za-z0-9-أ-ي-pL\s\-]+$/u',
                ];
            }
            default: break;
        }

    }

    public function messages()
    {
        return [
            'firstName.required' => 'هذا الحقل مطلوب',
            'firstName.regex' => 'يجب ان يكون الحقل نصي',
            'secondName.required' => 'هذا الحقل مطلوب',
            'secondName.regex' => 'يجب ان يكون الحقل نصي',
            'thirdName.required' => 'هذا الحقل مطلوب',
            'thirdName.regex' => 'يجب ان يكون الحقل نصي',
            'lastName.required' => 'هذا الحقل مطلوب',
            'lastName.regex' => 'يجب ان يكون الحقل نصي',
            'gender.required' => 'هذا الحقل مطلوب',

            'id_number.required' => 'هذا الحقل مطلوب',
            'id_number.digits' => 'يجب ان يكون عدد الارقام 9  ',
            'id_number.numeric' => 'يجب ان يكون الحقل رقم',
            'id_number.unique' => 'القيمة مستخدمة من قبل',

            'PhoneNumber.required' => 'هذا الحقل مطلوب',
            'PhoneNumber.digits' => 'يجب ان يكون عدد الارقام 10 ',
            'PhoneNumber.numeric' => 'يجب ان يكون الحقل رقم',
            'PhoneNumber.unique' => 'القيمة مستخدمة من قبل',

            'family_member.required' => 'هذا الحقل مطلوب',
            'family_member.numeric' => 'يجب ان يكون الحقل رقم',
            'city_id.required' => 'هذا الحقل مطلوب',
            'address.required' => 'هذا الحقل مطلوب',
            'maritial.required' => 'هذا الحقل مطلوب',

        ];
    }
}
