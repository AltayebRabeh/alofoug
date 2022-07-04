<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class MenuLink extends Model
{
    use HasFactory, HasTranslations;
    protected $guarded = [];

    public $translatable = ['name'];

    public $timestamps = false;

    public function menu(){
        return $this->belongsTo(Menu::class);
    }

    public function link(){
        return $this->belongsTo(Link::class);
    }

    public function childrens(){
        return $this->hasMany(MenuLink::class, 'parent_id');
    }
}
