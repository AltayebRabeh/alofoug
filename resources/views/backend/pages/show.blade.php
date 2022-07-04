@extends('layouts.backend.admin')

@section('content')
<div class="content-wrapper">
    <div class="content-header row">
        <div class="content-header-left col-md-6 col-12 mb-2">
            <h3 class="content-header-name mb-0 cairo">الصفحات</h3>
            <div class="row breadcrumbs-top">
                <div class="breadcrumb-wrapper col-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">لوحة التحكم</a>
                        </li>
                        <li class="breadcrumb-item"><a href="{{ route('pages.index') }}">الصفحات</a>
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
                        <h4 class="card-name cairo">الصفحة بالعربي</h4>
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                        <div class="heading-elements">
                            <ul class="list-inline mb-0">
                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-content collapse show">
                        <img class="card-img-top img-fluid" src="{{ $page->thumbnail }}" alt="{{ $page->name }}">
                        <div class="card-body">
                            <h1 class="card-title cairo">{{ $page->name }}</h1>
                            <p class="card-text">{!! $page->content !!}</p>
                            <p class="card-text d-flex justify-content-between align-items-center">
                                <small class="text-muted">{{ $page->created_at }}</small>
                                <a class="btn btn-primary btn-sm" href="{{ $page->link->url }}">زيارة الصفحة</a>
                            </p>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <h4 class="card-name cairo">الصفحة بالنجليزي</h4>
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                        <div class="heading-elements">
                            <ul class="list-inline mb-0">
                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-content collapse show">
                        <img class="card-img-top img-fluid" src="{{ $page->thumbnail }}" alt="{{ $page->getTranslation('name', 'en') }}">
                        <div class="card-body">
                            <h1 class="card-title cairo">{{ $page->getTranslation('name', 'en') }}</h1>
                            <p class="card-text">{!! $page->getTranslation('content', 'en') !!}</p>
                            <p class="card-text d-flex justify-content-between align-items-center">
                                <small class="text-muted">{{ $page->created_at }}</small>
                                <a class="btn btn-primary btn-sm" href="{{ $page->link->url }}">زيارة الصفحة</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

