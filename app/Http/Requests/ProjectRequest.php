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

            'main_branch_id' =>  ['required'],
            'project_name' => ['required', 'string','max:225','regex:/^[A-Za-z0-9-أ-ي-pL\s\-]+$/u'],
            'grant_date' =>  ['required', 'date'],
            'category_id' =>  ['required'],
            'grant_value' => ['required','numeric'] ,
            'currency_id' => ['required'],
            'exchange_amount' => ['required','numeric'],
            'managerial_fees' =>  ['required','string','max:100'],
            'start_date'=> ['required', 'date'],

            'invoice.file.*'=>'mimes:jpg,jpeg,csv,txt,xlx,xls,pdf',
            'url'=>'nullable|url|regex:/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-])\/?$/',
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
