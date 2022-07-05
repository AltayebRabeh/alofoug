<?php

namespace App\Models;

use Spatie\Sitemap\Tags\Url;
use Spatie\Sluggable\HasSlug;
use Spatie\Searchable\Searchable;
use Spatie\Sluggable\SlugOptions;
use Spatie\Searchable\SearchResult;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class Post extends Model implements Searchable
{
    use HasFactory, HasTranslations, HasSlug;

    protected $guarded = [];

    public $timestamps = true;

    public $translatable = ['title', 'content'];

    public function getSlugOptions() : SlugOptions
    {
        LaravelLocalization::setLocale('en');
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug');
    }

    public function categories() {
        return $this->belongsToMany(Category::class, 'post_category');
    }

    protected function mediaType(): Attribute
    {

        return new Attribute(
            get: fn () => $this->getMediaType(),
        );
    }

    // Get media type
    private function getMediaType() {

        $allowPhotoExtensions = ['jpg', 'jpeg', 'png', 'ico', 'gif'];

        $photoExtension =  strtolower(collect(explode('.', $this->thumbnail))->pop());

        if(array_search($photoExtension, $allowPhotoExtensions) != '') {
            return 'image';
        }

        return 'video';
    }

    protected function visitors(): Attribute
    {
        return new Attribute(
            get: fn () => Visitor::whereUrl(LaravelLocalization::getNonLocalizedURL(route('news.events.single', $this->slug)))->distinct('ip_address')->count('ip_address'),
        );
    }

    public function getSearchResult(): SearchResult
    {
       $url = request()->search_type ? route('news.events.single', $this->slug) : route('posts.show', $this->id);

        return new \Spatie\Searchable\SearchResult(
           $this,
           __('Events & News') . ' > ' . $this->title,
           $url
        );
    }

    public function toSitemapTag(): Url | string | array
    {
        return route('news.events.single', $this->slug);
    }

    protected $appends = ['media_type'];
}
