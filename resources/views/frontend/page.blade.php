@extends('layouts.frontend.app')

@section('title')
{{ $page->name }}
@endsection

@section('description')
{{ $page->content }}
@endsection

@section('url')
{{ route('page', $page->slug) }}
@endsection

@section('image')
{{ $page->thumbnail ?? $cache_settings ? $cache_settings->min_logo : '' }}
@endsection

@section('content')

<div class="page">
    @if ($page->thumbnail)
    <div class="image-box">
        <img class="w-100" src="{{ $page->thumbnail }}" alt="" srcset="">
    </div>
    @endif
    <div class="container">
        <div class="text-center">
            <h1 class="h3 mb-5 center-title">{{ Str::title($page->name) }}</h1>
        </div>
        {!! $page->content !!}
    </div>
</div>

@endsection
