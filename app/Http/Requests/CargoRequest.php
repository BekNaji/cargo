<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CargoRequest extends FormRequest
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
            'sender_id' => 'required',
            'receiver_id' => 'required',
            'payment' => 'required',
            //'category_id' => 'required',
            'status_id' => 'required',
            'baza_id' => 'required'
        ];
    }
}
