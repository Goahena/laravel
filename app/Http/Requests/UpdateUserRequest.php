<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
    public function rules(): array
    {
        return [
            'email' => 'required|string|email|unique:users,email,'.$this->id.'|max:191',
            'name' => 'required|string',
            'user_catalogue_id' => 'gt:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'phone' => 'required|regex:/^[0-9]{3}[-\s]?[0-9]{3}[-\s]?[0-9]{4}$/',
        ];
    }
    public function messages(): array
    {
        return [
            'email.required' => 'Bạn chưa nhập email',
            'email.unique' => 'Email đã tồn tại, hãy chọn email khác',
            'email.string' => 'Email phải là dạng ký tự',
            'email.max' => 'Độ dài email tối đa 191 ký tự',
            'email.email' => 'Email chưa đúng định dạng. Ví dụ: abc@gmail.com',
            'name.required' => 'Bạn chưa nhập Họ và Tên',
            'name.string' => 'Họ và Tên phải là dạng ký tự',
            'user_catalogue_id.gt' => 'Hãy chọn nhóm thành viên',
            'image.image' => 'Ảnh đại diện không phải định dạng ảnh',
            'image.mimes' => 'Hãy tải ảnh có định dạng jpeg, png, jpg, gif, svg',
            'image.max' => 'Tên hình ảnh không vượt quá 2048 ký tự',
        ];
    }
}
