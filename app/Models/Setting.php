<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Setting extends Model
{
    use HasFactory, HasTranslations;
    protected $guarded = [];

    public $translatable = ['bio', 'name', 'address'];

    public $timestamps = false;
}
