<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Link;
use App\Models\PdfPage;
use App\Models\MenuLink;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Requests\StorePdfPageRequest;
use App\Http\Requests\UpdatePdfPageRequest;

class PdfPageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pdfPages = PdfPage::latest()->with('link')->paginate(Cache::get('cache_settings')->paginate??20);

        return view('backend.pdf_pages.index', compact('pdfPages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.pdf_pages.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePdfPageRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePdfPageRequest $request)
    {
        try {
            DB::beginTransaction();

            $pdfPage = PdfPage::create([
                'name' => [
                   'ar' => $request->name,
                   'en' => $request->name_en
                ],
                'pdf' => [
                    'ar' => $request->pdf,
                    'en' => $request->pdf_en
                ]
            ]);

            $link = Link::create([
                'name' => [
                    'ar' => $request->name,
                    'en' => $request->name_en,
                ],
                'url' => url('pdf/'.$pdfPage->slug),
                'linkable_type' => PdfPage::class,
                'linkable_id' => $pdfPage->id,
                'primary' => true
            ]);

            $main_menu = MenuLink::create([
                'menu_id' => 1,
                'link_id' => $link->id,
            ]);

            DB::commit();

            Alert::success('نجاح','تم حفظ صفحة ال PDF بنجاح');
            return redirect()->route('pdf.pages.index');
        } catch (Exception $e) {
            DB::rollBack();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PdfPage  $pdfPage
     * @return \Illuminate\Http\Response
     */
    public function show(PdfPage $pdfPage)
    {
        $pdfPage = PdfPage::with('link')->findOrFail($pdfPage->id);

        if(!$pdfPage)
            abort(404);

        return view('backend.pdf_pages.show', compact('pdfPage'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PdfPage  $pdfPage
     * @return \Illuminate\Http\Response
     */
    public function edit(PdfPage $pdfPage)
    {
        return view('backend.pdf_pages.edit', compact('pdfPage'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePdfPageRequest  $request
     * @param  \App\Models\PdfPage  $pdfPage
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePdfPageRequest $request, PdfPage $pdfPage)
    {
        try {

            DB::beginTransaction();
            $pdfPage = PdfPage::findOrFail($pdfPage->id);

            if(!$pdfPage) {
                abort(404);
            }

            $pdfPage->update([
                'name' => [
                    'ar' => $request->name,
                    'en' => $request->name_en
                ],
                'pdf' => [
                    'ar' => $request->pdf,
                    'en' => $request->pdf_en
                ]
            ]);

            Link::where('linkable_id', $pdfPage->id)->where('linkable_type', PdfPage::class)->update([
                'name' => [
                    'ar' => $request->name,
                    'en' => $request->name_en,
                ],
                'url' => url('pdf/'.$pdfPage->slug),
            ]);

            DB::commit();

            Alert::success('نجاح','تم تعديل صفحة ال PDF بنجاح');
            return redirect()->route('pdf.pages.index');

        } catch (Exception $e) {
            DB::rollBack();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PdfPage  $pdfPage
     * @return \Illuminate\Http\Response
     */
    public function destroy(PdfPage $pdfPage)
    {
        PdfPage::findOrFail($pdfPage->id)->delete();

        $link = Link::where('linkable_id', $pdfPage->id)->where('linkable_type', Page::class)->first();
        $link->delete();
        $menuLinks = MenuLink::where('link_id', $link->id)->get();

        foreach($menuLinks as $menuLink) {
            MenuLink::where('parent_id', $menuLink->id)->update(['parent_id' => null]);
            $menuLink->delete();
        }

        Alert::success('نجاح','تم حذف صفحة ال PDF بنجاح');
        return redirect()->route('pdf.pages.index');
    }
}
