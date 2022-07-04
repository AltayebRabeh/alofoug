@extends('layouts.backend.admin')

@section('content')
<div class="content-wrapper">
    <div class="content-header row">
        <div class="content-header-left col-md-6 col-12 mb-2">
            <h3 class="content-header-name mb-0 cairo">الشريط المتحرك</h3>
            <div class="row breadcrumbs-top">
                <div class="breadcrumb-wrapper col-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">لوحة التحكم</a>
                        </li>
                        <li class="breadcrumb-item"><a href="{{ route('slides.index') }}">الشريط المتحرك</a>
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
                        <h4 class="card-name cairo">محتوى الشريط بالعربي</h4>
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                        <div class="heading-elements">
                            <ul class="list-inline mb-0">
                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-content collapse show">
                        <img class="card-img-top img-fluid" src="{{ $slide->image }}" alt="{{ $slide->title }}">
                        <div class="card-body">
                            <h1 class="card-title cairo">{{ $slide->title }}</h1>
                            <p class="card-text">{!! $slide->description !!}</p>
                            <p class="card-text d-flex justify-content-between align-items-center">
                                <small class="text-muted">{{ $slide->created_at }}</small>
                            </p>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <h4 class="card-name cairo">محتوى الشريط بالنجليزي</h4>
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                        <div class="heading-elements">
                            <ul class="list-inline mb-0">
                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-content collapse show">
                        <img class="card-img-top img-fluid" src="{{ $slide->image }}" alt="{{ $slide->getTranslation('title', 'en') }}">
                        <div class="card-body">
                            <h1 class="card-title cairo">{{ $slide->getTranslation('title', 'en') }}</h1>
                            <p class="card-text">{!! $slide->getTranslation('description', 'en') !!}</p>
                            <p class="card-text d-flex justify-content-between align-items-center">
                                <small class="text-muted">{{ $slide->created_at }}</small>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

