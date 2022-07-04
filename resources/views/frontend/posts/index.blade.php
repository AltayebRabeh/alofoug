@extends('layouts.frontend.app')

@section('title')
{{ __('Events & News') }}
@endsection

@section('description')
{{ $cache_settings ? $cache_settings->bio : '' }}
@endsection

@section('url')
{{ route('news.events') }}
@endsection

@section('image')
{{ $cache_settings ? $cache_settings->min_logo : '' }}
@endsection

@section('content')

<div class="news">
    <div class="container">
        <div class="text-center">
            <h3 class="h3 mb-5 center-title">{{ __('Events & News') }}</h3>
        </div>
        <div class="row">

            @foreach ($posts as $post)
                <div class="col-md-6 col-lg-3">
                    <a href="{{ route('news.events.single', $post->slug) }}">
                        <div class="card shadow mb-3">
                            @if ($post->thumbnail)
                                <div class="image-box">
                                    @if($post->media_type == 'image')
                                        <div class="image" style="background-image: url({{$post->thumbnail}});"></div>
                                    @else
                                        <div style="background-image: url({{asset('25481.jpg')}});height: 100%;background-position: center center;background-size: cover;"></div>
                                    @endif
                                </div>
                            @endif
                            <div class="card-body">
                                <h5 class="card-title">{{ Str::limit(Str::title($post->title), 28) }}</h5>
                                <p class="card-text">{{ Str::limit(strip_tags($post->content), 60) }}</p>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach

        </div>
        <div class="paginate d-flex justify-content-center">
            {{ $posts->links() }}
        </div>
    </div>
</div>

@endsection
