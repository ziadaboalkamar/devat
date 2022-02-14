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

              'company_name' =>  ['required', 'string','max:225'],
                'project_name' => ['required', 'string','max:225'],
                'grant_date' =>  ['required', 'date'],
                'category_id' =>  ['required', 'numeric'],
                'grant_value' => ['required', 'numeric'] ,
                'currency_id' => ['required', 'numeric'],
                'exchange_amount' =>  ['required', 'string','max:225'],
                'managerial_fees' =>  ['required', 'string','max:100'],
                'start_date'=> ['required', 'date'],
        ];
    }
    public function messages()
    {
        return [
            'required'=>"هذا الحقل مطلوب.",
            'string' =>'يجب ادخال في الاحراف.',
            'max'=>'هذا الحقل طويل للغاية.',
            'numeric' => 'يجب ادخال رقم'
        ];
    }
}
