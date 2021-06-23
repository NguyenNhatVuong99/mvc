<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductImportRequest extends FormRequest
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
            'partner_code' => 'required',
            'date_import'=>'required',
            'date_delivery'=>'required|after_or_equal:date-import',
            'total_price'=>'required',
            'total_quantity'=>'required',
            
        ];
    }
    public function messages()
    {
        return [
            'required' => 'Vui lòng nhập :attribute',
            'after'=>'Ngày giao hàng phải sau ngày nhập hàng'
        ];
    }
    public function attributes()
    {
        return [
            'partner_code' => 'nhà cung cấp',
            'date-import' => 'ngày nhập hàng',
            'date-delivery' => 'ngày giao hàng',
            'total_price' => 'tổng thành tiền',
            'total_quantity' => 'tổng số lượng',
        ];
    }
}
