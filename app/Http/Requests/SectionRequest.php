<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SectionRequest extends FormRequest
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
            "section_name"=>'required|unique:sections|max:255',
            "description"=>'required'
        ];
    }
    public function messages()
    {
        return[
            'section_name.required'=>"الاسم مطلوب",
            'section_name.unique'=>"هذا الاسم موجود مسبقا",
            'section_name.max'=>"الاسم لا يجب ان يتعدي 255 حرف",
            'description.required'=>"الوصف مطلوب",
        ];
    }
}
