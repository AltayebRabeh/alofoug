@extends('layouts.frontend.app')

@section('title')
{{ $pdfPage->name }}
@endsection

@section('description')
{{ $cache_settings ? $cache_settings->bio : '' }}
@endsection

@section('url')
{{ route('pdf.page', $pdfPage->slug) }}
@endsection

@section('image')
{{ $cache_settings ? $cache_settings->min_logo : '' }}
@endsection

@section('content')

<div class="page">
    <div class="container">
        <div class="text-center">
            <h1 class="h3 mb-5 center-title">{{ Str::title($pdfPage->name) }}</h1>
        </div>
        <iframe id="pdf" width="100%" style="height: 90vh" src="{{$pdfPage->pdf}}#toolbar=0" frameborder="0"></iframe>
    </div>
</div>

@endsection

