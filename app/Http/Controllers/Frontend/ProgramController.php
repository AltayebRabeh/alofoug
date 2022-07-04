<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;
use App\Models\Program;

class ProgramController extends Controller
{
    public function index()
    {
        $programs = Program::latest()->whereNotNull('e_learning_url')->paginate(Cache::get('cache_settings')->paginate??20);
        return view('frontend.programs.index', compact('programs'));
    }

    public function show($id)
    {
        $program = Program::findOrFail($id);
        return view('frontend.programs.show', compact('program'));
    }
}
