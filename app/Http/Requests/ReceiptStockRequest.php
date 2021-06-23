<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReceiptStockRequest extends FormRequest
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
        switch ($this->method()) {
            case 'POST':
                return [
                    'partner_code' => 'required',
                    'array' => 'required',
                    'payment'=>'lte:total|integer',
                    
                ];
                break;
            
            default:
                # code...
                break;
        }

    }
    public function messages()
    {
        return [
            'required' => 'Vui lòng chọn :attribute.',
            'integer' => ':attribute không đúng định dạng.',
            'lte' => [
                'numeric' => ':attribute phải nhỏ hơn hoặc bằng :value.',
                'file' => ':attribute phải nhỏ hơn hoặc bằng :value kilobytes.',
                'string' => ':attribute phải nhỏ hơn hoặc bằng :value characters.',
                'array' => ':attribute phải nhỏ hơn hoặc bằng :value items.',
            ],
        ];
    }
    public function attributes()
    {
        return [
            'partner_code' => 'nhà cung cấp',
            'array' => 'sản phẩm',
            'payment'=>'số tiền thanh toán'
        ];
    }
}
