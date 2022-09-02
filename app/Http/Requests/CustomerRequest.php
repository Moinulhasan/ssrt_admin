<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomerRequest extends FormRequest
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
            'name'=>'required|string',
            'surname'=>'nullable|string',
            'email'=>'required|email|unique:customers,email,'.decrypt($this->id),
            'password'=>'required|min:5',
            'company_name'=>'required|string',
            'abn'=>'required|max:14',
            'phone'=>'nullable|string',
            'fax'=>'nullable|string',
            'start_subscription'=>'required|date',
            'end_subscription'=>'required|after:start_subscription|date',
            'grace'=>'nullable|between:0,99',
            'line_one'=>'nullable|string',
            'line_two'=>'nullable|string',
            'subrub'=>'nullable|string',
            'state'=>'nullable|max:3',
            'postcode'=>'nullable|digits:4',
            'note'=>'nullable|string',
            'pos.*'=>'nullable'
        ];

    }
}
