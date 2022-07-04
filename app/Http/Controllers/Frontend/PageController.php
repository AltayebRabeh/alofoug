<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Page;
use App\Http\Controllers\Controller;
use App\Models\PdfPage;

class PageController extends Controller
{
    public function show($slug) {
        $page = Page::whereSlug($slug)->first();

        if(!$page)
            abort('404');

        return view('frontend.page', compact('page'));
    }

    public function pdf($slug) {
        $pdfPage = PdfPage::whereSlug($slug)->first();

        if(!$pdfPage)
            abort('404');

        return view('frontend.pdf_page', compact('pdfPage'));
    }
}
