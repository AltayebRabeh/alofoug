<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Page;
use App\Models\Post;
use App\Models\PdfPage;
use Illuminate\Http\Request;
use Spatie\Searchable\Search;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Artisan;

class HomeController extends Controller
{
    public function index() {
        // Artisan::call('key:generate');
        // Artisan::call('config:cache');
        // Artisan::call('route:cache');
        // Artisan::call('view:cache');
        // Artisan::call('route:trans:cache');
        // Artisan::call('storage:link');
        // Artisan::call('migrate:fresh --seed');
        // return "Done";

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
