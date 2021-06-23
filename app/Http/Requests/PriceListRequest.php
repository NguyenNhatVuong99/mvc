<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PriceListRequest extends FormRequest
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
                    'title' => 'required|unique:price_lists',
                    'start_date'=>'required',
                    'end_date'=>'required|after_or_equal:end_date',
                ];
                break;
            
            default:
                return [
                    'title'=>'required|string|unique:price_lists,title,' . $this->id,
                    'start_date'=>'required',
                    'end_date'=>'required|after_or_equal:end_date',
                    'status'=>'required',
                ];
                break;
        }
    }
    public function messages()
    {
        return [
            'required' => 'Vui lòng nhập :attribute',
            'unique' => ':attribute đã tồn tại',
            'after'=>'Ngày kết thúc phải sau ngày bắt đầu',

        ];
    }
    public function attributes()
    {
        return [
            'title' => 'tên bảng giá',
            'start_date' => 'ngày bắt đầu',
            'end_date' => 'ngày kết thúc',
        ];
    }
}
