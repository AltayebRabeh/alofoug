<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Classroom extends Model
{
    use HasFactory, HasTranslations;
    protected $guarded = [];

    public $translatable = ['name'];

    public $timestamps = false;

    public function programs() {
        return $this->belongsToMany(Program::class, 'program_classroom');
    }

    public function result() {
        return $this->hasMany(Result::class);
    }
}
