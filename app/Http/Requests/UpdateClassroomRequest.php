<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateClassroomRequest extends FormRequest
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
            'name_en' => 'required|max:255'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'إسم الفصل بالعربي مطلوب',
            'name.max' => 'لايجب ان يتجاوز إسم الفصل بالعربي 255 خانة',
            'name_en.required' => 'إسم الفصل بالانجليزي مطلوب',
            'name_en.max' => 'لايجب ان يتجاوز إسم الفصل بالانجليزي 255 خانة',
        ];
    }
}
