@extends('layouts.frontend.app')

@section('title')
{{ $program->name }}
@endsection

@section('description')
{{ $cache_settings ? $cache_settings->bio : '' }}
@endsection

@section('url')
{{ route('programs.show', $program->id) }}
@endsection

@section('image')
{{ $program->image ?? $cache_settings ? $cache_settings->min_logo : '' }}
@endsection

@section('content')

<div class="page">
    @if ($program->image)
    <div class="image-box">
        <img class="w-100" src="{{ $program->image }}" alt="" srcset="">
    </div>
    @endif
    <div class="container">
        <div class="text-center">
            <h1 class="h3 mb-5 center-title">{{ Str::title($program->name) }}</h1>
        </div>
        {!! $program->description !!}
    </div>
</div>

@endsection
