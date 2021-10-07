<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateInvoices extends FormRequest
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
            'invoice_number'=>'required',
            'invoice_Date'=>'required',
            'due_date'=>'Due_date',
            'section_id'=>'required',
            'amount_collection'=>'required',
            'amount_commission'=>'required',
            'discount'=>'required',
            'value_vat'=>'required',
            'rate_vat'=>'required',
            'total'=>'required',
            'note'=>'required',
        ];
    }
    public function messages()
    {
        return[
           
        ];
    }



}
