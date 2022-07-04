<?php

namespace App\Http\Controllers;

use App\Models\Link;
use App\Models\MenuLink;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use App\Http\Requests\StoreLinkRequest;
use App\Http\Requests\UpdateLinkRequest;
use RealRashid\SweetAlert\Facades\Alert;

class LinkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $main_menu = MenuLink::with([
                'childrens' => function($q) {
                    return $q->with('link')->orderBy('order');
                },
                'link'
            ])
            ->where('parent_id', null)
            ->where('menu_id', 1)
            ->orderBy('order')
            ->get();

        $under_menu = MenuLink::with(['link'])
        ->orderBy('order')
        ->where('menu_id', 2)->get();

        $links = Link::with('linkable')->get();
        return view('backend.links.index', compact('links', 'main_menu', 'under_menu'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorelinkRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreLinkRequest $request)
    {
        Link::create([
            'name' => [
                'ar' => $request->name,
                'en' => $request->name_en,
            ],
            'url' => $request->url,
            'linkable_type' => Link::class,
            'linkable_id' => 0
        ]);

        $this->cache();

        Alert::success('نجاح','تم حفظ الرابط بنجاح');
        return redirect()->route('links.index');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatelinkRequest  $request
     * @param  \App\Models\link  $link
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateLinkRequest $request, Link $link)
    {
        $link = Link::findOrFail($link->id);

        if($link->primary || $link->linkable_id) {
            $link->update([
                'name' => [
                    'ar' => $request->name,
                    'en' => $request->name_en,
                ]
            ]);
        } else {
            $link->update([
                'name' => [
                    'ar' => $request->name,
                    'en' => $request->name_en,
                ],
                'url' => $request->url
            ]);
        }

        $this->cache();

        Alert::success('نجاح','تم تعديل الرابط بنجاح');
        return redirect()->route('links.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\link  $link
     * @return \Illuminate\Http\Response
     */
    public function destroy(Link $link)
    {
        $link = Link::findOrFail($link->id);

        if($link->primary || $link->linkable_id)
        {
            Alert::error('خطاْ','هذا الرابط لايمكن حذفه');
            return redirect()->route('links.index');
        }

        $link->delete();

        $this->cache();

        Alert::success('نجاح','تم حذف الرابط بنجاح');
        return redirect()->route('links.index');
    }

    public function addToMainMenu(Request $request, Link $link)
    {
        $main_menu = MenuLink::create([
            'menu_id' => 1,
            'link_id' => $link->id,
        ]);

        if ($request->parent)
            $main_menu->parent_id = $request->parent;

        if ($request->order)
            $main_menu->order = $request->order;

        $main_menu->save();

        $this->cache();

        Alert::success('نجاح','تم إضافة الرابط إلى القائمة الرئيسية بنجاح');
        return redirect()->route('links.index');
    }

    public function addToUnderMenu(Request $request, Link $link)
    {
        $under_menu = MenuLink::create([
            'menu_id' => 2,
            'link_id' => $link->id,
        ]);

        if ($request->order)
            $under_menu->order = $request->order;

        $this->cache();

        Alert::success('نجاح','تم إضافة الرابط إلى القائمة السفلية بنجاح');
        return redirect()->route('links.index');
    }

    public function updateMainMenu(Request $request, MenuLink $menu_link)
    {
        $menu_link = MenuLink::with('childrens')->findOrFail($menu_link->id);

        $menu_link->parent_id = $request->parent;

        if($menu_link->childrens && $menu_link->parent_id != null) {
            foreach($menu_link->childrens as $child) {
                $child->update(['parent_id' => $menu_link->parent_id]);
            }
        }

        if ($request->order)
            $menu_link->order = $request->order?:0;

        $menu_link->save();

        $this->cache();

        Alert::success('نجاح','تم تعديل الرابط بنجاح');
        return redirect()->route('links.index');
    }

    public function updateUnderMenu(Request $request, MenuLink $menu_link)
    {
        $menu_link = MenuLink::findOrFail($menu_link->id);

        if ($request->order)
            $menu_link->order = $request->order?:0;

        $menu_link->save();

        $this->cache();

        Alert::success('نجاح','تم تعديل الرابط بنجاح');
        return redirect()->route('links.index');
    }

    public function destroyMenuLink(MenuLink $menu_link)
    {
        $menu_link = MenuLink::findOrFail($menu_link->id);


        $menu_link->delete();

        $this->cache();

        Alert::success('نجاح','تم حذف الرابط بنجاح');
        return redirect()->route('links.index');
    }

    public function cache() {

        Cache::flush('cache_main_menu');
        Cache::flush('cache_under_menu');

        Cache::rememberForever('cache_main_menu', function(){
            return MenuLink::with([
                'childrens' => function($q) {
                    return $q->with('link')->orderBy('order');
                },
                'link'
            ])
            ->where('parent_id', null)
            ->where('menu_id', 1)
            ->orderBy('order')

            ->get();
        });

        Cache::rememberForever('cache_under_menu', function(){
            return MenuLink::with(['link'])
            ->orderBy('order')
            ->where('menu_id', 2)->get();
        });
    }
}
