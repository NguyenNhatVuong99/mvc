<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ServiceShipRequest extends FormRequest
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
            'weight' => 'required|numeric|gt:0',
            'urban' => 'required|numeric|min:1000',
            'suburban' => 'required|numeric|min:1000',
            'more' => 'required|numeric|min:1000',
            'time' => 'required|numeric|gt:0',
        ];
    }
    public function messages()
    {
        return [
            'required' => 'Vui lòng điền :attribute',
            'numeric' => ':attribute không đúng định dạng',
            'gt' => ':attribute không được bằng 0',
            'min' => ':attribute phải lớn hơn 1000',
        ];
    }
    public function attributes()
    {
        return [
            'weight' => 'khối lượng',
            'urban' => 'giá nội thành',
            'suburban' => 'giá ngoại thành',
            'more' => 'giá khối lượng thêm',
            'time' => 'thời gian dự kiến',
        ];
    }
}
