<?php

namespace App\Providers;

use Carbon\Carbon;
use App\Models\Post;
use App\Models\Slide;
use App\Models\Contact;
use App\Models\Setting;
use App\Models\Visitor;
use App\Models\MenuLink;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();

        view()->composer('backend.*', function($view) {

            $view->with([
                'notifications' => Contact::latest()->whereRead(false)->limit(10)->get(),
                'notificationCount' => Contact::latest()->whereRead(false)->count(),
            ]);

        });


        view()->composer('*', function($view) {

            // Get Visitors
            $VisitorsPerDay = Visitor::whereYear('created_at', date('Y'))->WhereMonth('created_at', date('m'))->whereDay('created_at', date('d'))->distinct('ip_address')->count('ip_address');
            $VisitorsPerMonth = Visitor::whereYear('created_at', date('Y'))->WhereMonth('created_at', date('m'))->distinct('ip_address')->count('ip_address');
            $VisitorsPerYear = Visitor::whereYear('created_at', date('Y'))->distinct('ip_address')->count('ip_address');
            $allVisitors = Visitor::distinct('ip_address')->count('ip_address');


            if(! Cache::has('cache_recent_posts') ||
                ! Cache::has('cache_main_menu') ||
                ! Cache::has('cache_under_menu') ||
                ! Cache::has('cache_slides') ||
                ! Cache::has('cache_breaking_news') ||
                ! Cache::has('cache_settings')) {

                $recent_posts = Post::latest()->limit(Setting::find(1)->latest_posts_count)->get();

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

                $breaking_news = Post::select('title', 'slug')->latest()->whereBreakingNews(true)->get();

                $slides = Slide::latest()->get();

                $settings = Setting::find(1);

                if($recent_posts->first()){
                    Cache::rememberForever('cache_recent_posts', function() use($recent_posts){
                        return $recent_posts;
                    });
                }

                if($main_menu) {
                    Cache::rememberForever('cache_main_menu', function() use($main_menu){
                        return $main_menu;
                    });
                }

                if($under_menu) {
                    Cache::rememberForever('cache_under_menu', function() use($under_menu){
                        return $under_menu;
                    });
                }

                if($breaking_news) {
                    Cache::rememberForever('cache_breaking_news', function() use($breaking_news){
                        return $breaking_news;
                    });
                }

                if($slides) {
                    Cache::rememberForever('cache_slides', function() use($slides){
                        return $slides;
                    });
                }

                if($settings) {
                    Cache::rememberForever('cache_settings', function() use($settings){
                        return $settings;
                    });
                }

            }

            $recent_posts = Cache::get('cache_recent_posts');
            $main_menu = Cache::get('cache_main_menu');
            $under_menu = Cache::get('cache_under_menu');
            $breaking_news = Cache::get('cache_breaking_news');
            $slides = Cache::get('cache_slides');
            $settings = Cache::get('cache_settings');

            $view->with([
                'VisitorsPerDay' => $VisitorsPerDay,
                'VisitorsPerMonth' => $VisitorsPerMonth,
                'VisitorsPerYear' => $VisitorsPerYear,
                'allVisitors' => $allVisitors,

                'cache_recent_posts' => $recent_posts,
                'cache_main_menu' => $main_menu,
                'cache_under_menu' => $under_menu,
                'cache_breaking_news' => $breaking_news,
                'cache_slides' => $slides,
                'cache_settings' => $settings,
            ]);

        });
    }
}
