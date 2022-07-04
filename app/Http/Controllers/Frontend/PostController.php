<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Support\Facades\Cache;

class PostController extends Controller
{
    public function index() {
        $posts = Post::latest()->with('categories')->paginate(Cache::get('cache_settings')->paginate??20);
        return view('frontend.posts.index', compact('posts'));
    }

    public function show($slug) {
        $post = Post::with('categories')->whereSlug($slug)->first();

        if(!$post)
            abort('404');

        return view('frontend.posts.show', compact('post'));
    }

    public function category($slug) {
        $category = Category::with(['posts' => fn($q) => $q->latest()])->whereSlug($slug)->first();

        if(!$category)
            abort('404');

        return view('frontend.posts.category', compact('category'));
    }
}
