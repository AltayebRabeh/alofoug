<?php

namespace App\Models;

use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Contact extends Model implements Searchable
{
    use HasFactory;

    protected $guarded = [];

    public function replies()
    {
        return $this->hasMany(ContactReply::class);
    }

    public $timestamps = false;


    public function getSearchResult(): SearchResult
    {
       $url = route('contacts.show', $this->id);

        return new \Spatie\Searchable\SearchResult(
           $this,
           'المراسلات' . ' > ' . $this->name,
           $url
        );
    }
}
