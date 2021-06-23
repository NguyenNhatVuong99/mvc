<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SupplierRequest extends FormRequest
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
                     'name' => 'required|alpha_spaces|unique:suppliers',
                     'phone'=>'required|numeric',
                     'address'=>'required|',
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
             'required' => 'vui lòng nhập :attribute',
             'unique' => ':attribute đã tồn tại',
             'alpha_spaces'=>':attribute không đúng định dạng',
             'numeric'=>':attribute không đúng định dạng',
             'min'=>':attribute không đúng định dạng',
             'max'=>':attribute không đúng định dạng',
 
         ];
     }
     public function attributes()
     {
         return [
             'name' => 'tên',
             'phone' => 'số điện thoại',
             'address' => 'địa chỉ',
         ];
     }
}
