<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProgramRequest extends FormRequest
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
            'name.required' => 'إسم البرنامج بالعربي مطلوب',
            'name.max' => 'لايجب ان يتجاوز إسم البرنامج بالعربي 255 خانة',
            'name_en.required' => 'إسم البرنامج بالانجليزي مطلوب',
            'name_en.max' => 'لايجب ان يتجاوز إسم البرنامج بالانجليزي 255 خانة',
        ];
    }
}
