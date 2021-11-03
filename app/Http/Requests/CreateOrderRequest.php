<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateOrderRequest extends FormRequest
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
            'name' => 'required|min:1|max:255',
            'email' => 'required|min:1|max:255',
            // 'address' => 'required|min:1|max:255',
            'phone' => 'required|min:9|max:11',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Vui lòng nhập tên người mua',
            'email.required' => 'Vui lòng nhập email',
            // 'address.required' => 'Vui lòng nhập địa chỉ',
            'phone.required' => 'Vui lòng nhập số điện thoại',
            
        ];
    }
}
