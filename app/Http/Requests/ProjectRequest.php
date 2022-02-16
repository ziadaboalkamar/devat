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

<<<<<<< HEAD
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
=======
            'project_name' =>  ['required','string','regex:/^[A-Za-z0-9-أ-ي-pL\s\-]+$/u'],
            'grant_date' => ['required', 'string','max:225','regex:/^[A-Za-z0-9-أ-ي-pL\s\-]+$/u'],
            'category_id' =>  ['required'],
            'grant_value' =>  ['required', 'numeric'],
            'currency_id' => ['required', 'numeric'] ,
            'exchange_amount' => ['required', 'numeric'],
            'managerial_fees' =>  ['required', 'string','max:225'],
            'start_date' =>  ['required', 'string','max:100'],
            'main_branch_id'=> ['required', 'date'],
            'category_id'=>'required',
            'file'=>'nullable|mimes:jpg,jpeg,png|max:2000||max:50000|mimes:xlsx,doc,docx,ppt,pptx,ods,odt,odp,application/csv,application/excel,
            application/vnd.ms-excel, application/vnd.msexcel,
            text/csv, text/anytext, text/plain, text/x-c,
            text/comma-separated-values,
            inode/x-empty,
            application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            'url'=>'nullable|url|regex:/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/',
>>>>>>> b711b8feed5c8d2abd10369d6c1c82c3ff967071
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
