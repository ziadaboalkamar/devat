<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BeneficiariesProjectRequest extends FormRequest
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
            'project_id' => 'required',
            'beneficiary_id' => 'required',
            'branch_id' => 'required',
            'recever_name' => 'required',
            'family_member_count' => 'required',
            'add_by' => 'required',
            'delivery_date' => 'required',
            'employee_who_delivered' => 'required',
        ];
    }
}
