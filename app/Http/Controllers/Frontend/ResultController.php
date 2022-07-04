<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Result;
use App\Models\Program;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Rap2hpoutre\FastExcel\FastExcel;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;

class ResultController extends Controller
{
    public function show() {
        $programs = Program::whereHas('result')->get();
        return view('frontend.results.index', compact('programs'));
    }

    public function get(Request $request) {

        $validator = Validator::make($request->all(), [
            'program' => 'required|int|exists:programs,id',
            'classroom' => 'required|int|exists:classrooms,id',
            'student_number' => 'required'
        ], [
            'program.required' => __('The field is required'),
            'classroom.required' => __('The field is required'),
            'student_number.required' => __('The field is required'),
        ]);

        if($validator->fails())
            return redirect()->back()->withErrors($validator)->withInput();

        $result = Result::whereProgramId($request->program)->whereClassroomId($request->classroom)->first();

        $data = null;

        if($result)
            $data = (new FastExcel)->import(storage_path('app\results\\') . $result->file)->where('رقم الطالب', $request->student_number)->first();

        if(!$data) {
            Alert::error('', __('There is no result. Please verify your information or refer to the section concerned with the result'));
            return redirect()->back();
        }

        return view('frontend.results.show', compact('result', 'data'));
    }
}
