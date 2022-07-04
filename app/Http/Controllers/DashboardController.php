<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\Post;
use App\Models\User;
use App\Models\Contact;
use App\Models\PdfPage;
use App\Models\Program;
use App\Models\Visitor;
use Illuminate\Http\Request;
use Spatie\Searchable\Search;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index() {
        $programs = Program::count();
        $posts = Post::count();
        $visitors = Visitor::distinct('ip_address')->count('ip_address');
        $contacts = Contact::count();

        $pageVisits = Visitor::select('url', DB::raw('count(*) as total'))
        ->groupBy('url')
        ->limit(20)
        ->get();

        return view('backend.dashboard', compact('pageVisits', 'programs', 'posts', 'visitors', 'contacts'));
    }

    public function search(Request $request) {
        $searchResults = (new Search())
        ->registerModel(Post::class, ['title', 'content'])
        ->registerModel(Page::class, ['name', 'content'])
        ->registerModel(PdfPage::class, ['name'])
        ->registerModel(Contact::class, ['name', 'email', 'subject', 'message'])
            ->registerModel(User::class, 'name', 'email')
            ->search($request->search);

        return view('backend.search', compact('searchResults'));
    }
}
