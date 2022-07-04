<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
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
            'title' => 'required|max:255',
            'title_en' => 'required|max:255',
            'content' => 'required',
            'content_en' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'الحقل مطلوب',
            'title.max' => 'اقصى حد مسموح به 255 خانة',
            'title_en.required' => 'الحقل مطلوب',
            'title_en.max' => 'اقصى حد مسموح به 255 خانة',
            'content.required' => 'الحقل مطلوب',
            'content_en.required' => 'الحقل مطلوب',
        ];
    }
}
