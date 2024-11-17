<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
{
    /**
     * Determine if the Product is authorized to make this request.
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
        'name' => 'required|string|max:255',
        'brand_id' => 'required|exists:brands,id',
        'shoe_type_id' => 'required|exists:shoe_types,id',
        'promotion_id' => 'nullable|exists:promotions,id',
        'image_1' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        'image_2' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        'image_3' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        'image_4' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        // Các rule khác
    ];
}

    public function messages(): array
    {
        return [
            'name.required' => 'Bạn chưa nhập Tên Nhóm Thành Viên',
            'name.string' => 'Tên Nhóm Thành Viên phải là dạng ký tự',
        ];
    }
}
