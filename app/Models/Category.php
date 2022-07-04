<?php

namespace App\Models;

use Spatie\Sitemap\Tags\Url;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class Category extends Model
{
    use HasFactory, HasSlug, HasTranslations;

    protected $guarded = [];

    public $timestamps = true;

    public $translatable = ['name'];

    public function getSlugOptions() : SlugOptions
    {
        LaravelLocalization::setLocale('en');
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }

    public function toSitemapTag(): Url | string | array
    {
        return route('category', $this->slug);
    }

    public function posts() {
        return $this->belongsToMany(Post::class, 'post_category');
    }
}
