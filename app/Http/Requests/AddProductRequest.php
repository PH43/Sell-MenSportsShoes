<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddProductRequest extends FormRequest
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
            'name' => 'required|unique:products,name|min:3|max:255',
            'price' => 'required|min:3|max:255',
            'desc' => 'required|min:3|max:1000',
            'image' => 'required|min:3|max:255',
            'size' => 'required|array|min:1',
            'size.*' => 'int|exists:sizes,id',
            'quantity' => 'required|array|min:1',
            'quantity.*' => 'required|numeric|between:0,100|int'

        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Bạn chưa nhập tên sản phẩm',
            'name.unique' => 'Tên sản phẩm này đã tồn tại',
            'price.required' => 'Bạn chưa nhập giá tiền',
            'desc.required' => 'Bạn chưa nhập Mô Tả',
            'image.required' => 'Bạn chưa chọn Hình Ảnh',
            'quantity.*.required' => 'Bạn chưa nhập số lượng của size',
            'quantity.*.numeric' => 'Nhập số',
            'quantity.*.between' => 'Nhập số từ 0-100',

        ];
    }
}
