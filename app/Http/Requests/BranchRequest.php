<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class BranchRequest extends FormRequest
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
            'name' => 'required|min:3|max:255|'.Rule::unique('branches','name')->ignore(request('id'),'id'),
            'phone' => 'required|max:255',
            'address_from' => 'required|max:255',
            'address_to' => 'required|max:255',
            'status' => 'required',
            'receiver_smsconfig_id' => 'required',
            'sender_smsconfig_id' => 'required',
            'logo' => 'image|max:2048|mimes:jpeg,jpg,png'
        ];
    }
}
