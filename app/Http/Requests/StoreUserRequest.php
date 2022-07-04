<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required|min:3|max:255',
            'email' => 'required|max:255|email|unique:users,email',
            'password' => 'required|min:6|max:255|confirmed',
            'password_confirmation' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'الحقل مطلوب',
            'name.min' => 'يجب ان لايقل عن 3 خانات',
            'name.max' => 'يجب ان لايزيد عن 255 خانة',
            'email.required' => 'الحقل مطلوب',
            'email.email' => 'يجب ان يكون بريد الكتروني',
            'email.unique' => 'البريد الالكتروني مستخدم مسبقاً',
            'email.max' => 'يجب ان لايزيد عن 255 خانة',
            'password.required' => 'الحقل مطلوب',
            'password.min' => 'يجب ان لايقل عن 6 خانات',
            'password.max' => 'يجب ان لايزيد عن 255 خانة',
            'password.confirmed' => 'كلمات المرور غير متطابقة',
            'password_confirmation.required' => 'الحقل مطلوب',
        ];
    }
}
