<?php

namespace App\Models;

use Spatie\Sitemap\Tags\Url;
use Spatie\Sluggable\HasSlug;
use Spatie\Searchable\Searchable;
use Spatie\Sluggable\SlugOptions;
use Spatie\Searchable\SearchResult;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class PdfPage extends Model implements Searchable
{
    use HasFactory, HasTranslations, HasSlug;

    protected $guarded = [];

    public $timestamps = true;

    public $translatable = ['name', 'pdf'];

    public function getSlugOptions() : SlugOptions
    {
        LaravelLocalization::setLocale('en');
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }

    public function getSearchResult(): SearchResult
    {
       $url = request()->search_type ? route('pdf.page', $this->slug) : route('pdf.pages.show', $this->id);

        return new \Spatie\Searchable\SearchResult(
           $this,
           __('PDF Page') . ' > ' . $this->name,
           $url
        );
    }

    public function toSitemapTag(): Url | string | array
    {
        return route('pdf.page', $this->slug);
    }

    public function link() {
        return $this->morphOne(Link::class, 'linkable');
    }
}
