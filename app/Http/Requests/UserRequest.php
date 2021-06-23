<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
        switch ($this->request->get('isPersonel')) {
            case '0':
                return [
                    'role'=>'required',
                    'name' => 'required|unique:users',
                    'email'=>'required|email|unique:users',
                    'phone'=>'required|numeric|unique:users',
                    'password'=>'required',
                    'province'=>'required',
                    'district'=>'required',
                    'ward'=>'required',
                    'address'=>'required'

                ];
                break;
            
            default:
                return [
                    'role'=>'required',
                    'name' => 'required|unique:users',
                    'email'=>'required|email|unique:users',
                    'phone'=>'required|numeric|unique:users',
                    'password'=>'required',
                    'province'=>'required',
                    'district'=>'required',
                    'ward'=>'required',
                    'address'=>'required',
                    'start_date'=>'required',
                    'category_work'=>'required',
                    'type_salary'=>'required',
                    'salary'=>'required'
                    

                ];
        }
        
    }
    public function messages()
    {
        return [
            'required' => 'Vui lòng nhập :attribute',
            'unique' => ':attribute đã tồn tại',
            'alpha_spaces'=>':attribute không đúng định dạng',
            'email'=>':attribute không đúng định dạng',
            'numeric'=>':attribute không đúng định dạng',
            'min'=>':attribute không đúng định dạng',
            'max'=>':attribute không đúng định dạng',

        ];
    }
    public function attributes()
    {
        return [
            'role' => 'nhóm',
            'salary' => 'tiền lương',
            'type_salary' => 'hình thức lương',
            'category_work' => 'hình thức công việc',
            'start_date' => 'thời gian bắt đầu',
            'name' => 'tên',
            'email' => 'email',
            'phone' => 'số điện thoại',
            'address' => 'địa chỉ',
            'ward' => 'xã - phường',
            'district' => 'quận - huyện',
            'province' => 'tỉnh - thành phố',
        ];
    }
}
