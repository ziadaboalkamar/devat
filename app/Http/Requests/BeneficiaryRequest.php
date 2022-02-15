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
                    'id_number' => 'required|unique:beneficiaries|numeric',
                    'PhoneNumber' => 'required|numeric|unique:beneficiaries',
                    'family_member' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/',
                    'branch_id' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/',
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
                    'gender' => 'required|regex:/^[A-Za-z0-9-أ-ي-pL\s\-]+$/u',
                    'id_number' => 'required|unique:beneficiaries,id_number,'.$this->route()->beneficiarei->id,
                    'PhoneNumber' => 'required|numeric|unique:beneficiaries,PhoneNumber,'.$this->route()->beneficiarei->id,
                    'family_member' => 'required|numeric|regex:/^([0-9\s\-\+\(\)]*)$/',
                    'branch_id' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/',
                    'city_id' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/',
                    'address' => 'required|regex:/^[A-Za-z0-9-أ-ي-pL\s\-]+$/u',
                    'maritial' => 'required|regex:/^[A-Za-z0-9-أ-ي-pL\s\-]+$/u',
                ];
            }
            default: break;
        }
    }
}
