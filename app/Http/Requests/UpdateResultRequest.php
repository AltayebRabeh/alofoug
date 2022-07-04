<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateResultRequest extends FormRequest
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
            'program' => 'required|integer|exists:programs,id',
            'classroom' => 'required|integer|exists:classrooms,id',
            'end_date' => 'nullable|after:today'
        ];
    }

    public function messages()
    {
        return [
            'program.required' => 'الحقل مطلوب',
            'program.integer' => 'يجب إختيار قيمة صحيحة',
            'program.exists' => 'تم اختيار قيمة غير صالحة',
            'classroom.required' => 'الحقل مطلوب',
            'classroom.integer' => 'يجب إختيار قيمة صحيحة',
            'classroom.exists' => 'تم اختيار قيمة غير صالحة',
            'end_date.after' => 'يجب ان يكون التاريخ اكبر من تاريخ اليوم',
        ];
    }
}
