<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'email' => 'required|string|email|unique:users|max:191',
            'name' => 'required|string',
            'user_catalogue_id' => 'gt:0',
            'password' => 'required|string|min:6',
            're_password' => 'string|same:password'
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
            'password.required' => 'Bạn chưa nhập mật khẩu',
            'password.string' => 'Bạn chưa nhập mật khẩu',
            'password.min' => 'Mật khẩu phải nhiều hơn 6 ký tự',
            're_password.same' => 'Bạn chưa nhập mật khẩu',
            're_password.string' => 'Xác nhận lại mật khẩu chưa chính xác',
        ];
    }
}
