<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
{
    /**
     * Determine if the Prodcut is authorized to make this request.
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
    public function rules(): array
    {
        return [
            'name' => 'required|string',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];
    }
    public function messages(): array
    {
        return [
            
            'name.required' => 'Bạn chưa nhập Họ và Tên',
            'name.string' => 'Họ và Tên phải là dạng ký tự',
            'image.image' => 'Ảnh đại diện không phải định dạng ảnh',
            'image.mimes' => 'Hãy tải ảnh có định dạng jpeg, png, jpg, gif, svg',
            'image.max' => 'Tên hình ảnh không vượt quá 2048 ký tự',
        ];
    }
}
