<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Degree;
use App\Models\Program;
use App\Models\Classroom;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Requests\StoreProgramRequest;
use App\Http\Requests\UpdateProgramRequest;

class ProgramController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $programs = Program::latest()->with(['classrooms'])->paginate(Cache::get('cache_settings')->paginate??20);

        return view('backend.programs.index', compact('programs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $classrooms = Classroom::all();
        return view('backend.programs.create', compact('classrooms'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreprogramRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProgramRequest $request)
    {
        try {
            DB::beginTransaction();

            $program = Program::create([
                'name' => [
                   'ar' => $request->name,
                   'en' => $request->name_en
                ],
                'description' => [
                    'ar' => $request->description,
                    'en' => $request->description_en
                ],
                'e_learning_url' => $request->e_learning_url,
                'image' => $request->image,
            ]);

            $program->classrooms()->sync($request->classrooms);


            DB::commit();

            Alert::success('نجاح','تم حفظ البرنامج بنجاح');
            return redirect()->route('programs.index');
        } catch (Exception $e) {
            dd($e->getMessage());
            DB::rollBack();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\program  $program
     * @return \Illuminate\Http\Response
     */
    public function show(Program $program)
    {
        $program = Program::with(['classrooms'])->findOrFail($program->id);

        if(!$program)
            abort(404);

        return view('backend.programs.show', compact('program'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\program  $program
     * @return \Illuminate\Http\Response
     */
    public function edit(Program $program)
    {
        $classrooms = Classroom::all();

        $program = Program::with(['classrooms'])->findOrFail($program->id);

        return view('backend.programs.edit', compact('program', 'classrooms'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateprogramRequest  $request
     * @param  \App\Models\program  $program
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProgramRequest $request, Program $program)
    {
        try {

            DB::beginTransaction();
            $program = Program::findOrFail($program->id);

            if(!$program) {
                abort(404);
            }

            $program->update([
                'name' => [
                    'ar' => $request->name,
                    'en' => $request->name_en
                ],
                'description' => [
                    'ar' => $request->description,
                    'en' => $request->description_en
                ],
                'e_learning_url' => $request->e_learning_url,
                'image' => $request->image,
            ]);

            $program->classrooms()->sync($request->classrooms);

            DB::commit();

            Alert::success('نجاح','تم تعديل البرنامج بنجاح');
            return redirect()->route('programs.index');

        } catch (Exception $e) {
            DB::rollBack();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\program  $program
     * @return \Illuminate\Http\Response
     */
    public function destroy(Program $program)
    {
        $program = Program::findOrFail($program->id)->delete();

        Alert::success('نجاح','تم حذف البرنامج بنجاح');
        return redirect()->route('programs.index');
    }
}
