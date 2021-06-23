<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddressRequest extends FormRequest
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
            'name' => 'required|string',
            'phone' => 'required|numeric|min:10',
            'address' => 'required|string',
            'province' => 'required',
            'district' => 'required',
            'ward' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'required' => 'Vui lòng điền :attribute',
            'string' => ':attribute phải có dạng chữ',
            'numeric' => ':attribute phải có dạng số',
            'min' => ':attribute phải lớn hơn 10 số',
        ];
    }
    public function attributes()
    {
        return [
            'name' => 'họ và tên',
            'phone' => 'số điện thoại',
            'address' => 'địa chỉ',
            'province' => 'tỉnh - thành phố',
            'district' => 'quận - huyện',
            'ward' => 'xã - phường',
        ];
    }
}
