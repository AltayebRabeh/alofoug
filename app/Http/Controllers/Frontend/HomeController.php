<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Page;
use App\Models\Post;
use App\Models\PdfPage;
use Illuminate\Http\Request;
use Spatie\Searchable\Search;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index() {
        return view('frontend.index');
    }

    public function search(Request $request) {
        $searchResults = (new Search())
        ->registerModel(Post::class, ['title', 'content'])
        ->registerModel(Page::class, ['name', 'content'])
        ->registerModel(PdfPage::class, ['name'])
        ->search($request->search);
        // return $searchResults;
        return view('frontend.search', compact('searchResults'));
    }
}
