<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FoodRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules()
{
    return [
        'name' => 'required|min:5',
        'category' => 'required',
        'price' => 'required|numeric|min:1000',
        'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        'description' => 'required|max:500', // Thêm dòng này để kiểm tra mô tả
    ];
}

public function messages()
{
    return [
        'name.required' => 'Tên thực phẩm không được để trống.',
        'name.min' => 'Tên thực phẩm phải có ít nhất 5 ký tự.',
        'category.required' => 'Vui lòng chọn danh mục thực phẩm.',
        'price.required' => 'Giá sản phẩm là bắt buộc.',
        'price.numeric' => 'Giá phải là định dạng số.',
        'image.required' => 'Vui lòng chọn một hình ảnh.',
        'image.image' => 'File tải lên phải là định dạng ảnh.',
        'description.required' => 'Vui lòng nhập mô tả cho thực phẩm.', // Thông báo lỗi description
        'description.max' => 'Mô tả không được vượt quá 500 ký tự.',
    ];
}
}
