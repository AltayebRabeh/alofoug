@extends('layouts.backend.admin')

@section('css')
    <style>
        #toolbar {
            display: none;
        }
    </style>
@endsection

@section('content')
<div class="content-wrapper">
    <div class="content-header row">
        <div class="content-header-left col-md-6 col-12 mb-2">
            <h3 class="content-header-name mb-0 cairo">صفحات الـ PDF</h3>
            <div class="row breadcrumbs-top">
                <div class="breadcrumb-wrapper col-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">لوحة التحكم</a>
                        </li>
                        <li class="breadcrumb-item"><a href="{{ route('pdf.pages.index') }}">صفحات الـ PDF</a>
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
                        <h4 class="card-name cairo">صفحة الـ PDF بالعربي</h4>
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                        <div class="heading-elements">
                            <ul class="list-inline mb-0">
                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-content collapse show">
                        <div class="card-body">
                            <h1 class="card-title cairo">{{ $pdfPage->name }}</h1>
                            <iframe width="100%" style="height: 80vh" src="{{$pdfPage->pdf}}#toolbar=0" frameborder="0"></iframe>
                            <p class="card-text d-flex justify-content-between align-items-center">
                                <small class="text-muted">{{ $pdfPage->created_at }}</small>
                                <a class="btn btn-primary btn-sm" href="{{ $pdfPage->link->url }}">زيارة صفحة الـ PDF</a>
                            </p>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <h4 class="card-name cairo">صفحة الـ PDF بالنجليزي</h4>
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                        <div class="heading-elements">
                            <ul class="list-inline mb-0">
                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-content collapse show">
                        <div class="card-body">
                            <h1 class="card-title cairo">{{ $pdfPage->getTranslation('name', 'en') }}</h1>
                            <iframe width="100%" style="height: 80vh" src="{{$pdfPage->getTranslation('pdf', 'en')}}#toolbar=0" frameborder="0"></iframe>
                            <p class="card-text d-flex justify-content-between align-items-center">
                                <small class="text-muted">{{ $pdfPage->created_at }}</small>
                                <a class="btn btn-primary btn-sm" href="{{ $pdfPage->link->url }}">زيارة صفحة الـ PDF</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

