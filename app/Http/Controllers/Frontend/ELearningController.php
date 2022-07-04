<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Program;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;

class ELearningController extends Controller
{
    public function index()
    {
        $programs = Program::latest()->whereNotNull('e_learning_url')->paginate(Cache::get('cache_settings')->paginate??20);
        return view('frontend/e_learning', compact('programs'));
    }
}
