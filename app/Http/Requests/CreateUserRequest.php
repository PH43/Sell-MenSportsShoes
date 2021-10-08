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
            'email' => 'required|unique:users,name|min:3|max:255',
            'phone' => 'min:1|max:11',
            'password' => 'required|min:3|max:255',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Bạn chưa nhập tên thành viên',
            'email.required' => 'Bạn chưa nhập email',
            'email.unique' => 'Email này đã tồn tại',
            'password.required' => 'Bạn chưa nhập Mật khẩu',
        ];
    }
}
