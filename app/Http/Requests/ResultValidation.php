<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ResultValidation extends FormRequest
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
            'firstname' => 'required',
            'lastname' => 'required',
            'middlename' => 'nullable',
            'user_phone' =>'required',
            'org_name' => 'required',
            'service_name' => 'required',
            'reg_date' => 'required|date',
            'result_date' => 'required|date',
            'status' => 'required',
            'files' => 'required',
            'files_description' => 'required'
        ];
    }
}
