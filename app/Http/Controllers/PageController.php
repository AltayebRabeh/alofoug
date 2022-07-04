<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Link;
use App\Models\Page;
use App\Models\MenuLink;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use App\Http\Requests\StorePageRequest;
use App\Http\Requests\UpdatePageRequest;
use RealRashid\SweetAlert\Facades\Alert;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pages = Page::latest()->with('link')->paginate(Cache::get('cache_settings')->paginate??20);

        return view('backend.pages.index', compact('pages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.pages.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorepageRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePageRequest $request)
    {
        try {
            DB::beginTransaction();

            $page = Page::create([
                'name' => [
                   'ar' => $request->name,
                   'en' => $request->name_en
                ],
                'content' => [
                    'ar' => $request->content,
                    'en' => $request->content_en
                 ],
                 'thumbnail' => $request->thumbnail,
            ]);

            $link = Link::create([
                'name' => [
                    'ar' => $request->name,
                    'en' => $request->name_en,
                ],
                'url' => url($page->slug),
                'linkable_type' => Page::class,
                'linkable_id' => $page->id,
                'primary' => true
            ]);

            $main_menu = MenuLink::create([
                'menu_id' => 1,
                'link_id' => $link->id,
            ]);

            DB::commit();

            Alert::success('نجاح','تم حفظ الصفحة بنجاح');
            return redirect()->route('pages.index');
        } catch (Exception $e) {
            DB::rollBack();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\page  $page
     * @return \Illuminate\Http\Response
     */
    public function show(Page $page)
    {
        $page = Page::with('link')->findOrFail($page->id);

        if(!$page)
            abort(404);

        return view('backend.pages.show', compact('page'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\page  $page
     * @return \Illuminate\Http\Response
     */
    public function edit(Page $page)
    {
        return view('backend.pages.edit', compact('page'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatepageRequest  $request
     * @param  \App\Models\page  $page
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePageRequest $request, Page $page)
    {
        try {

            DB::beginTransaction();
            $page = Page::findOrFail($page->id);

            if(!$page) {
                abort(404);
            }

            $page->update([
                'name' => [
                    'ar' => $request->name,
                    'en' => $request->name_en
                ],
                'content' => [
                    'ar' => $request->content,
                    'en' => $request->content_en
                ],
                'thumbnail' => $request->thumbnail,
            ]);

            Link::where('linkable_id', $page->id)->where('linkable_type', Page::class)->update([
                'name' => [
                    'ar' => $request->name,
                    'en' => $request->name_en,
                ],
                'url' => url($page->slug),
            ]);

            DB::commit();

            Alert::success('نجاح','تم تعديل الصفحة بنجاح');
            return redirect()->route('pages.index');

        } catch (Exception $e) {
            DB::rollBack();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\page  $page
     * @return \Illuminate\Http\Response
     */
    public function destroy(Page $page)
    {
        Page::findOrFail($page->id)->delete();

        $link = Link::where('linkable_id', $page->id)->where('linkable_type', Page::class)->first();
        $link->delete();
        $menuLinks = MenuLink::where('link_id', $link->id)->get();

        foreach($menuLinks as $menuLink) {
            MenuLink::where('parent_id', $menuLink->id)->update(['parent_id' => null]);
            $menuLink->delete();
        }

        Alert::success('نجاح','تم حذف الصفحة بنجاح');
        return redirect()->route('pages.index');
    }
}
