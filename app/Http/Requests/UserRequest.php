<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
           'name'       => 'required',
            'email'     => 'required',
            'phone'     => 'required',
            'address'   => 'required',
            'password'  => 'required',
        ];
    }
    public function message(){
         return [
            'name.required'         => 'The name is required ',
            'email.required'   => 'The email is required',
            'phone.required'       => 'The phone is required',
            'address.required'   => 'The address is required',
            'password.required'          => 'The password is required',  
    ];
    }
}
