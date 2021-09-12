<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ReceiverRequest extends FormRequest
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
            'name' => 'required|max:255',
            'passport' => 'required|max:10|min:7|'.Rule::unique('passports','passport')->ignore(request('id'),'customer_id'),
            'phones.*' => 'required|max:9|min:9|'.Rule::unique('phones','phone')->ignore(request('id'),'customer_id'),
        ];
    }
}
