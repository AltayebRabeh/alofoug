@extends('layouts.frontend.app')

@section('title')
{{ $category->name }}
@endsection

@section('description')
{{ $category->description }}
@endsection

@section('url')
{{ route('category', $category->slug) }}
@endsection

@section('image')
{{ $cache_settings ? $cache_settings->min_logo : '' }}
@endsection

@section('content')

<div class="news">
    <div class="container">
        <div class="text-center">
            <h3 class="h3 mb-5 center-title">{{ $category->name }}</h3>
        </div>
        <div class="row">

            @foreach ($category->posts as $post)
                <div class="col-md-6 col-lg-3">
                    <a href="{{ route('news.events.single', $post->slug) }}">
                        <div class="card shadow mb-3">
                            <div class="image-box">
                                @if($post->media_type == 'image')
                                    <div class="image" style="background-image: url({{$post->thumbnail}});"></div>
                                @else
                                    <video width="100%" height="200" controls>
                                        <source src="{{ $post->thumbnail }}">
                                        Your browser does not support the video tag.
                                    </video>
                                @endif
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">{{ Str::limit(Str::title($post->title), 28) }}</h5>
                                <p class="card-text">{{ Str::limit(strip_tags($post->content), 60) }}</p>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach

        </div>
    </div>
</div>

@endsection
