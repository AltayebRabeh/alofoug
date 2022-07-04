<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Setting;
use App\Models\Category;
use Illuminate\Support\Facades\Cache;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use RealRashid\SweetAlert\Facades\Alert;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::latest()->with('categories')->paginate(Cache::get('cache_settings')->paginate??20);

        return view('backend.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();

        return view('backend.posts.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePostRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePostRequest $request)
    {
        $post = Post::create([
            'title' => [
               'ar' => $request->title,
               'en' => $request->title_en
            ],
            'content' => [
                'ar' => $request->content,
                'en' => $request->content_en
             ],
             'thumbnail' => $request->thumbnail,
        ]);

        if ($request->breaking_news) {
            $post->breaking_news = true;
            $post->save();
        }

        $post->categories()->sync($request->categories);

        $this->cache();

        Alert::success('نجاح','تم حفظ الحدث | الخبر بنجاح');
        return redirect()->route('posts.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        $post = Post::with('categories')->findOrFail($post->id);

        if(!$post)
            abort(404);

        return view('backend.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $categories = Category::all();
        ;
        return view('backend.posts.edit', compact('post', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePostRequest  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        $post = Post::findOrFail($post->id);

        if(!$post) {
            abort(404);
        }

        $post->update([
            'title' => [
                'ar' => $request->title,
                'en' => $request->title_en
             ],
             'content' => [
                 'ar' => $request->content,
                 'en' => $request->content_en
              ],
              'thumbnail' => $request->thumbnail,
        ]);

        $post->categories()->sync($request->categories);

        if ($request->breaking_news) {
            $post->breaking_news = true;
        } else {
            $post->breaking_news = false;
        }

        $post->save();

        $this->cache();

        Alert::success('نجاح','تم تعديل الحدث | الخبر بنجاح');
        return redirect()->route('posts.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post = Post::findOrFail($post->id);

        if($post)
            $post->delete();

        $this->cache();

        Alert::success('نجاح','تم حذف الحدث | الخبر بنجاح');
        return redirect()->route('posts.index');
    }

    public function breakingNews()
    {
        $posts = Post::whereBreakingNews(true)->with('categories')->paginate(Cache::get('cache_settings')->paginate??20);

        return view('backend.posts.breaking_news', compact('posts'));
    }

    public function cache() {
        Cache::flush('cache_recent_posts');
        Cache::rememberForever('cache_recent_posts', function(){
            return Post::latest()->limit(Setting::find(1)->latest_posts_count)->get();
        });

        Cache::flush('cache_breaking_news');
        Cache::rememberForever('cache_breaking_news', function(){
            return Post::whereBreakingNews(true)->latest()->get();
        });
    }

}
