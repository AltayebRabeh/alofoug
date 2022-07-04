@extends('layouts.backend.admin')

@section('content')
<div class="content-wrapper">
    <div class="content-header row">
        <div class="content-header-left col-md-6 col-12 mb-2">
            <h3 class="content-header-title mb-0 cairo">الاحداث | الاخبار</h3>
            <div class="row breadcrumbs-top">
                <div class="breadcrumb-wrapper col-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">لوحة التحكم</a>
                        </li>
                        <li class="breadcrumb-item"><a href="{{ route('posts.index') }}">الاحداث | الاخبار</a>
                        </li>
                        <li class="breadcrumb-item active">عرض
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="content-body">

        <div class="row" id="default">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h1 class="card-title cairo">تفاصيل الحدث | الخبر بالعربي</h1>
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                        <div class="heading-elements">
                            <ul class="list-inline mb-0">
                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-content collapse show">
                        @if ($post->thumbnail)
                            @if($post->media_type == 'image')
                            <img class="card-img-top img-fluid" src="{{ $post->thumbnail }}" alt="{{ $post->title }}">
                            @else
                            <video width="100%" controls>
                                <source src="{{ $post->thumbnail }}">
                                Your browser does not support the video tag.
                            </video>
                            @endif
                        @endif
                        <div class="card-body">
                            <h4 class="card-title cairo">{{ $post->title }}</h4>
                            <p class="card-text">{!! $post->content !!}</p>
                            <div class="card-text d-flex justify-content-between align-items-center">
                                <small class="text-muted">{{ $post->created_at }}</small>
                                <small class="text-muted">عدد المشاهدات {{ $post->visitors }}</small>

                                <div class="categories">
                                    @foreach ($post->categories as $category)
                                        <a href="{{ route('categories.show', $category->id) }}" class="badge badge-info">{{ $category->name }}</a>
                                    @endforeach
                                </div>
                                @if ($post->breaking_news)
                                    <span class="badge badge-danger">عاجل</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title cairo">تفاصيل الحدث | الخبر بالنجليزي</h4>
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                        <div class="heading-elements">
                            <ul class="list-inline mb-0">
                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-content collapse show">
                        @if ($post->thumbnail)
                            @if($post->media_type == 'image')
                            <img class="card-img-top img-fluid" src="{{ $post->thumbnail }}" alt="{{ $post->title }}">
                            @else
                            <video width="100%" controls>
                                <source src="{{ $post->thumbnail }}">
                                Your browser does not support the video tag.
                            </video>
                            @endif
                        @endif
                        <div class="card-body">
                            <h1 class="card-title cairo">{{ $post->getTranslation('title', 'en') }}</h1>
                            <p class="card-text">{!! $post->getTranslation('content', 'en') !!}</p>
                            <div class="card-text d-flex justify-content-between align-items-center">
                                <small class="text-muted">{{ $post->created_at }}</small>

                                <small class="text-muted">عدد المشاهدات {{ $post->visitors }}</small>

                                <div class="categories">
                                    @foreach ($post->categories as $category)
                                        <a href="{{ route('categories.show', $category->id) }}" class="badge badge-info">{{ $category->getTranslation('name', 'en') }}</a>
                                    @endforeach
                                </div>

                                @if ($post->breaking_news)
                                    <span class="badge badge-danger">عاجل</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

