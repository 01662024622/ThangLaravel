<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
            'name'      => 'required',
            'parent_id'     => 'required',
            'sort_order'        => 'required|numeric',
        ];
    }
     public function message(){
         return [
            'name.required'         => 'The name is required ',
            'parent_id.required'   => 'The parent_id is required',
            'sort_order.required'       => 'The sort order is required',
            'sort_order.numeric'       => 'The sort order is not number',
    ];
    }
}
