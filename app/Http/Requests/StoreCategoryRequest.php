<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCategoryRequest extends FormRequest
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
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'الحقل مطلوب',
            'name.max' => 'اقصى حد مسموح به 255 خانة',
            'name_en.required' => 'الحقل مطلوب',
            'name_en.max' => 'اقصى حد مسموح به 255 خانة',
        ];
    }
}
