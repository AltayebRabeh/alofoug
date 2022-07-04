<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Link extends Model
{
    use HasFactory, HasTranslations;

    protected $guarded = [];

    public $timestamps = true;

    public $translatable = ['name'];

    public function linkable() {
        return $this->morphTo();
    }

    public function menu() {
        return $this->hasMany(MenuLink::class);
    }
}
