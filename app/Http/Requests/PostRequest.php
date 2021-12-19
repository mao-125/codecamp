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
            'comment' => ['required', 'max:200'],
            'image' => [
              'file', 
              'image', 
              'mimes:jpeg,jpg,png', 
              'dimensions:min_width=100,min_height=100,max_width=1500,max_height=1500', 
            ],
        ];
    }
}
