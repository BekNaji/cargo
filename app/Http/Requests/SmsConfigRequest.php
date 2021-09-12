<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SmsConfigRequest extends FormRequest
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
            'name' => 'required|max:255|'.Rule::unique('smsconfigs','name')->ignore(request('id'),'id'),
            'title' => 'required|max:255|'.Rule::unique('smsconfigs','title')->ignore(request('id'),'id'),
            'login' => 'required|max:255',
            'password' => 'required|max:255',
            'token' => 'required|max:1000',
            'message' => 'required|max:255',
            'module' => 'required|max:255',
        ];
    }
}
