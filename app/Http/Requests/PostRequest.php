<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
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
           'title'          => 'required',
            'description'   => 'required',
            'content'       => 'required',
            'category_id'   => 'required',
            'tags'          => 'required',
            // 'image'         => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];
    }
    public function message(){
         return [
            'title.required'         => 'The title is required ',
            'description.required'   => 'The description is required',
            'content.required'       => 'The content is required',
            'category_id.required'   => 'The category_id is required',
            'tags.required'          => 'The tags is required',
            // 'image.image'            => 'This is not image',    
    ];
    }
    
}
