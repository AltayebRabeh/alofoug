<?php

namespace App\Http\Controllers;

use App\Models\Degree;
use Illuminate\Support\Facades\Cache;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Requests\StoreDegreeRequest;
use App\Http\Requests\UpdateDegreeRequest;

class DegreeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $degrees = Degree::latest('id')->paginate(Cache::get('cache_settings')->paginate??20);

        return view('backend.degrees.index', compact('degrees'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreDegreeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDegreeRequest $request)
    {
        Degree::create(['name' => ['ar' => $request->name, 'en' => $request->name_en]]);

        Alert::success('نجاح','تم حفظ الدرجة العلمية بنجاح');
        return redirect()->route('degrees.index');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateDegreeRequest  $request
     * @param  \App\Models\Degree  $degree
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDegreeRequest $request, Degree $degree)
    {
        $degree = Degree::findOrFail($degree->id);

        $degree->update(['name' => ['ar' => $request->name, 'en' => $request->name_en]]);

        Alert::success('نجاح','تم تعديل الدرجة العلمية بنجاح');
        return redirect()->route('degrees.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Degree  $degree
     * @return \Illuminate\Http\Response
     */
    public function destroy(Degree $degree)
    {
        $degree = Degree::findOrFail($degree->id);

        if($degree)
            $degree->delete();

        Alert::success('نجاح','تم حذف الدرجة العلمية بنجاح');
        return redirect()->route('degrees.index');
    }
}
