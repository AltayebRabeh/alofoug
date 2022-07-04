<?php

namespace App\Http\Controllers;

use App\Models\slide;
use Illuminate\Support\Facades\Cache;
use App\Http\Requests\StoreSlideRequest;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Requests\UpdateSlideRequest;

class SlideController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $slides = Slide::latest()->paginate(Cache::get('cache_settings')->paginate??20);

        return view('backend.slides.index', compact('slides'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.slides.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreslideRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSlideRequest $request)
    {
        $slide = Slide::create([
            'title' => [
               'ar' => $request->title,
               'en' => $request->title_en
            ],
            'description' => [
                'ar' => $request->description,
                'en' => $request->description_en
             ],
             'image' => $request->image,
        ]);

        $this->cache();

        Alert::success('نجاح','تم حفظ الشريط بنجاح');
        return redirect()->route('slides.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\slide  $slide
     * @return \Illuminate\Http\Response
     */
    public function show(Slide $slide)
    {
        $slide = Slide::findOrFail($slide->id);

        if(!$slide)
            abort(404);

        return view('backend.slides.show', compact('slide'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\slide  $slide
     * @return \Illuminate\Http\Response
     */
    public function edit(Slide $slide)
    {
        return view('backend.slides.edit', compact('slide'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateslideRequest  $request
     * @param  \App\Models\slide  $slide
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSlideRequest $request, Slide $slide)
    {
        $slide = Slide::findOrFail($slide->id);

        if(!$slide) {
            abort(404);
        }

        $slide->update([
            'title' => [
                'ar' => $request->title,
                'en' => $request->title_en
             ],
             'description' => [
                 'ar' => $request->description,
                 'en' => $request->descriptipn_en
              ],
              'image' => $request->image,
        ]);

        $this->cache();

        Alert::success('نجاح','تم تعديل الشريط بنجاح');
        return redirect()->route('slides.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\slide  $slide
     * @return \Illuminate\Http\Response
     */
    public function destroy(Slide $slide)
    {
        $slide = Slide::findOrFail($slide->id);

        if($slide)
            $slide->delete();

        $this->cache();

        Alert::success('نجاح','تم حذف الفصلحة بنجاح');
        return redirect()->route('slides.index');
    }

    public function cache() {
        Cache::flush('cache_slides');
        Cache::rememberForever('cache_slides', function(){
            return Slide::latest()->get();
        });
    }
}
