<?php

namespace App\Http\Controllers;

use App\Models\Result;
use App\Models\Program;
use Rap2hpoutre\FastExcel\FastExcel;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Requests\StoreResultRequest;
use App\Http\Requests\UpdateResultRequest;

class ResultController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $results = Result::latest()->with('program', 'classroom')->paginate(Cache::get('cache_settings')->paginate??20);

        return view('backend.results.index', compact('results'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $programs = Program::get();

        return view('backend.results.create', compact('programs'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreresultRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreResultRequest $request)
    {
        // // $data = Excel::import(new ResultsImport, storage_path('app\public\files\1\test.xlsx'), 'local', \Maatwebsite\Excel\Excel::XLSX);
        // $collection = (new FastExcel)->import(storage_path('app\public\files\1\alofoug.xlsx'));
        // // ->where('رقم الطالب', '20/61615345')->first()->toArray()
        // $collection = $collection->where('رقم الطالب', '20/61615345')->first();
        // foreach($collection as $key => $value) {
        //     dd($value);
        // }


        $excel = $request->excel;
        $extension = $excel->getClientOriginalExtension();
        $filename = pathinfo($excel->getClientOriginalName(), PATHINFO_FILENAME) . time() . '.' . $extension;

        if ($extension != 'xlsx') {
            Alert::error('خطا','الرجاء إختيار ملف اكسل صالح');
            return redirect()->back()->withInput();
        }

        if(Storage::putFileAs('results', $excel, $filename)) {

            $result = Result::create([
                'description' => [
                    'ar' => $request->description,
                    'en' => $request->description_en
                ],
                'file' => $filename,
                'end_date' => $request->end_date,
                'program_id' => $request->program,
                'classroom_id' => $request->classroom,
            ]);

            Alert::success('نجاح','تم حفظ النتيجة بنجاح');
            return redirect()->route('results.index')->withInput();

        }

        Alert::error('خطا','حدث خطا ما الرجاء مراجعة المدخلات');
        return redirect()->back()->withInput();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\result  $result
     * @return \Illuminate\Http\Response
     */
    public function show(result $result)
    {
        $excel = (new FastExcel)->import(storage_path('app\results\\') . $result->file);

        return view('backend.results.show', compact('result', 'excel'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\result  $result
     * @return \Illuminate\Http\Response
     */
    public function edit(Result $result)
    {
        $result = Result::with('program.classrooms')->findOrFail($result->id);

        $programs = Program::get();

        return view('backend.results.edit', compact('result', 'programs'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateresultRequest  $request
     * @param  \App\Models\result  $result
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateResultRequest $request, Result $result)
    {
        $result = Result::findOrFail($result->id);

        $values = [
            'description' => [
                'ar' => $request->description,
                'en' => $request->description_en
            ],
            'end_date' => $request->end_date,
            'program_id' => $request->program,
            'classroom_id' => $request->classroom,
        ];

        if($request->has('excel')) {
            $excel = $request->excel;
            $extension = $excel->getClientOriginalExtension();
            $filename = pathinfo($excel->getClientOriginalName(), PATHINFO_FILENAME) . time() . '.' . $extension;

            if ($extension != 'xlsx') {
                Alert::error('خطا','الرجاء إختيار ملف اكسل صالح');
                return redirect()->back()->withInput();
            }

            Storage::disk('results')->delete($result->file);
            Storage::putFileAs('results', $excel, $filename);

            $values['file'] = $filename;
        }


        $result->update($values);

        Alert::success('نجاح','تم حفظ النتيجة بنجاح');
        return redirect()->route('results.index')->withInput();

        Alert::error('خطا','حدث خطا ما الرجاء مراجعة المدخلات');
        return redirect()->back()->withInput();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\result  $result
     * @return \Illuminate\Http\Response
     */
    public function destroy(Result $result)
    {
        $result = Result::findOrFail($result->id);

        if(Storage::disk('results')->exists($result->file)) {
            Storage::disk('results')->delete($result->file);
        }

        $result->delete();

        Alert::success('نجاح','تم حذف النتيجة بنجاح');
        return redirect()->route('results.index');
    }
}
