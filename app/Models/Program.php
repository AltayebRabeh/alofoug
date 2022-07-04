<?php

namespace App\Models;

use Spatie\Sitemap\Tags\Url;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Program extends Model
{
    use HasFactory, HasTranslations;
    protected $guarded = [];

    public $translatable = ['name', 'description'];

    public $timestamps = true;

    public function toSitemapTag(): Url | string | array
    {
        return route('programs.show', $this->id);
    }

    public function classrooms() {
        return $this->belongsToMany(Classroom::class, 'program_classroom');
    }

    public function result() {
        return $this->hasMany(Result::class);
    }
}
