<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            //
            "Product_name"=>'required|max:255',
            "description"=>'required',
            "section_id"=>'required|integer',
        ];
    }


    public function messages()
    {
        return[
            'product_name.required'=>"الاسم مطلوب",
            'product_name.max'=>"الاسم لا يجب ان يتعدي 255 حرف",
            'description.required'=>"الوصف مطلوب",
        ];
    }


}
