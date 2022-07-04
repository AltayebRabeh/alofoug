<?php

namespace Database\Seeders;

use App\Models\Link;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LinkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Link::create([
            'name'=> [
                'ar' => 'إتصل بنا',
                'en' => 'Contact Us',
            ],
            'url' => url(config('app.url') . '/#contact-us'),
            'primary' => true,
            'linkable_type' => Link::class,
            'linkable_id' => 0
        ]);

        Link::create([
            'name'=> [
                'ar' => 'الاحداث والاخبار',
                'en' => 'Events & News',
            ],
            'url' => url('events-and-news'),
            'primary' => true,
            'linkable_type' => Link::class,
            'linkable_id' => 0
        ]);

        Link::create([
            'name'=> [
                'ar' => 'التعليم الالكتروني',
                'en' => 'E-Learning',
            ],
            'url' => url('/e-learning'),
            'primary' => true,
            'linkable_type' => Link::class,
            'linkable_id' => 0
        ]);

        Link::create([
            'name'=> [
                'ar' => 'النتائج',
                'en' => 'Results',
            ],
            'url' => url('/results'),
            'primary' => true,
            'linkable_type' => Link::class,
            'linkable_id' => 0
        ]);

        Link::create([
            'name'=> [
                'ar' => 'البرامج',
                'en' => 'Programs',
            ],
            'url' => url('/programs'),
            'primary' => true,
            'linkable_type' => Link::class,
            'linkable_id' => 0
        ]);

    }
}
