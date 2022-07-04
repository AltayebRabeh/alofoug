<?php

namespace App\Http\Controllers;

use App\Models\Program;
use App\Models\Classroom;
use Illuminate\Support\Facades\Cache;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Requests\StoreClassroomRequest;
use App\Http\Requests\UpdateClassroomRequest;

class ClassroomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $classrooms = Classroom::latest('id')->paginate(Cache::get('cache_settings')->paginate??20);

        return view('backend.classrooms.index', compact('classrooms'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreclassroomRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreClassroomRequest $request)
    {
        Classroom::create(['name' => ['ar' => $request->name, 'en' => $request->name_en]]);

        Alert::success('نجاح','تم حفظ الفصل بنجاح');
        return redirect()->route('classrooms.index');
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateclassroomRequest  $request
     * @param  \App\Models\classroom  $classroom
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateClassroomRequest $request, Classroom $classroom)
    {
        $classroom = Classroom::findOrFail($classroom->id);

        $classroom->update(['name' => ['ar' => $request->name, 'en' => $request->name_en]]);

        Alert::success('نجاح','تم تعديل الفصل بنجاح');
        return redirect()->route('classrooms.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\classroom  $classroom
     * @return \Illuminate\Http\Response
     */
    public function destroy(Classroom $classroom)
    {
        $classroom = Classroom::findOrFail($classroom->id);

        if($classroom)
            $classroom->delete();

        Alert::success('نجاح','تم حذف الفصل بنجاح');
        return redirect()->route('classrooms.index');
    }

    public function getClassroomsForProgram($program_id)
    {
        $program = Program::with(['classrooms'])->find($program_id);

        return $program->classrooms->pluck('name', 'id');
    }
}
