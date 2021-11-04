<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateUserRequest extends FormRequest
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
            'name' => 'required|min:3|max:255',
            'email' => 'required|unique:users,email|min:3|max:255',
            'phone' => 'required|numeric|unique:users,phone|digits:10',
            'password' => 'required|min:3|max:255',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Bạn chưa nhập tên thành viên',
            'email.required' => 'Bạn chưa nhập email',
            'email.unique' => 'Email này đã tồn tại',
            'phone.unique' => 'SDT này đã tồn tại',
            'phone.numeric' => 'SDT là số',
            'phone.required' => 'Nhập số điện thoại',
            'phone.digits' => 'Nhập đúng số điện thoại 10 số',
            'password.required' => 'Bạn chưa nhập Mật khẩu',
        ];
    }
}
