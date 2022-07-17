<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateLinkRequest extends FormRequest
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
            'name' => 'required|max:255',
            'name_en' => 'required|max:255',
            'url' => 'nullable|url'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'إسم الرابط بالعربي مطلوب',
            'name.max' => 'لايجب ان يتجاوز إسم الرابط بالعربي 255 خانة',
            'name_en.required' => 'إسم الرابط بالانجليزي مطلوب',
            'name_en.max' => 'لايجب ان يتجاوز إسم الرابط بالانجليزي 255 خانة',
            'url.required' => 'عنوان الرابط مطلوب',
            'url.url' => 'يجب إدخال عنوان رابط صحيح',
        ];
    }
}
