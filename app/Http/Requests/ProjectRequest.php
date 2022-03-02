<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProjectRequest extends FormRequest
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
            'main_branch_id' =>['required'],
            'project_name' => ['required', 'string','max:225'],
            'grant_date' =>  ['required', 'date'],
            'category_id' =>  ['required'],
            'donor_id' =>  ['required'],
            'grant_value' => ['required','numeric'] ,
            'currency_id' => ['required'],
            'exchange_amount' => ['required','numeric'],
            'start_date'=> ['required', 'date'],
            'managerial_fees' =>  ['required', 'string','max:225'],
        ];
    }
    public function messages()
    {
        return [
            'main_branch_id.required' => 'هذا الحقل مطلوب',
            'category_id.required' => 'هذا الحقل مطلوب',
            'donor_id.required' => 'هذا الحقل مطلوب',
            'currency_id.required' => 'هذا الحقل مطلوب',
            'grant_value.required' => 'هذا الحقل مطلوب',
            'grant_value.numeric' => 'يجب ان يكون الحقل رقمي',
            'exchange_amount.required' => 'هذا الحقل مطلوب',
            'exchange_amount.numeric' => 'يجب ان يكون الحقل رقمي',

            'project_name.required' => 'هذا الحقل مطلوب',
            'project_name.string' => 'يجب ان يكون الحق نصي',
            'managerial_fees.required' => 'هذا الحقل مطلوب',
            'managerial_fees.string' => 'يجب ان يكون الحق نصي',

            'grant_date.required' => 'هذا الحقل مطلوب',
            'grant_date.date' => 'يجب ان تكون الصيغة تاريخ',
            'start_date.required' => 'هذا الحقل مطلوب',
            'start_date.date' => 'يجب ان تكون الصيغة تاريخ',


        ];
    }
}
