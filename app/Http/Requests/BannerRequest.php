<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BannerRequest extends FormRequest
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
                    'title'=>'required|string|unique:banners',
                    'description'=>'required|string',
                    'photo'=>'required|string|unique:banners',
                    'status'=>'required|in:0,1',
                ];
                break;
            
            case 'PUT':
                return [
                    'title'=>'required|string|unique:banners,title,' . $this->id,
                    'description'=>'required|string',
                    'photo'=>'required|string|unique:banners,photo,' . $this->id,
                ];
                break;
        }
        
    }
    public function messages()
    {
        return [
            'required' => 'vui lòng nhập :attribute',
            'unique' => ':attribute đã tồn tại',
            'in'=>':attribute không đúng định dạng'

        ];
    }
    public function attributes()
    {
        return [
            'description' => 'mô tả',
            'title' => 'tiêu đề',
            'photo' => 'hình ảnh',
            'status' => 'trạng thái',
        ];
    }
}
