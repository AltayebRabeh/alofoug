@extends('layouts.frontend.app')

@section('title')
{{ $post->title }}
@endsection

@section('description')
{!! $post->content !!}
@endsection

@section('url')
{{ route('news.events.single', $post->slug) }}
@endsection

@section('image')
{{ $post->thumbnail ?? $cache_settings ? $cache_settings->min_logo : '' }}
@endsection

@section('content')

<div class="single-news">
    <div class="image-box">
        @if ($post->thumbnail)
            @if($post->media_type == 'image')
                <img src="{{ $post->thumbnail }}" alt="{{ $post->title }}" width="100%">
            @else
                <video width="100%" controls>
                    <source src="{{ $post->thumbnail }}">
                    Your browser does not support the video tag.
                </video>
            @endif
        @endif
    </div>
    <div class="container">
        <div class="text-center">
            <h1 class="h3 mb-5 center-title">{{ Str::title($post->title) }}</h1>
        </div>
        <div class="row">
            <div class="col-md-9 pb-5">
                {!! $post->content !!}
            </div>
            <div class="col-md-3">
                <aside>
                    <div class="box mb-4 mt-sm-5 mt-md-0">
                        <h5><i class="bi bi-watch"></i> {{ $post->created_at->diffForHumans() }}</h5>
                    </div>

                    <div class="box mb-4 mt-sm-5 mt-md-0">
                        <h5><i class="bi bi-eye"></i> {{ $post->visitors }}</h5>
                    </div>

                    <div class="box mb-4">
                        <h5>{{ __('Categories') }}</h5>
                        <div class="categories d-flex flex-wrap">
                            @forelse ($post->categories as $category)
                                <a href="{{ route('category', $category->slug) }}">{{ $category->name }}</a>
                            @empty
                                <a href="javascript:void()">{{ __('There is no category') }}</a>
                            @endforelse
                        </div>
                    </div>
                    <div class="box mb-4">
                        <h5>{{ __('Share') }}</h5>
                        <div class="share">
                            <!-- AddToAny BEGIN -->
                            <div class="a2a_kit a2a_kit_size_32 a2a_default_style d-flex flex-wrap">
                                <a class="a2a_dd" href="https://www.addtoany.com/share"></a>
                                <a class="a2a_button_facebook"></a>
                                <a class="a2a_button_twitter"></a>
                                <a class="a2a_button_email"></a>
                                <a class="a2a_button_whatsapp"></a>
                                <a class="a2a_button_linkedin"></a>
                                <a class="a2a_button_pinterest"></a>
                                <a class="a2a_button_facebook_messenger"></a>
                                <a class="a2a_button_telegram"></a>
                            </div>
                            <!-- AddToAny END -->
                        </div>
                    </div>
                </aside>
            </div>
        </div>
    </div>
</div>

@endsection

@section('js')
<script async src="https://static.addtoany.com/menu/page.js"></script>
@endsection
