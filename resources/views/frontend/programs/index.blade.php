@extends('layouts.frontend.app')

@section('title')
{{ __('College Programs') }}
@endsection

@section('description')
{{ $cache_settings ? $cache_settings->bio : '' }}
@endsection

@section('url')
{{ route('programs') }}
@endsection

@section('image')
{{ $cache_settings ? $cache_settings->min_logo : '' }}
@endsection

@section('content')
<div class="e_learning">
    <div class="container">
        <div class="text-center">
            <h1 class="h3 mb-5 center-title">{{ __('College Programs') }}</h1>
        </div>
        <div class="row">
            @foreach ($programs as $program)
            <div class="col-md-6 col-lg-3">
                <a href="{{ route('programs.show', $program->id) }}">
                    @if ($program->image)
                        <div class="card shadow mb-3 text-center">
                            <img src="{{ $program->image }}" alt="{{ $program->name }}">
                            <div class="card-body">
                                <h5 class="card-title">{{ $program->name }}</h5>
                            </div>
                        </div>
                    @else
                        <div class="card shadow mb-3 text-center">
                            <i class="bi bi-book" style="font-size: 60px;"></i>
                            <h5 class="card-title">{{ $program->name }}</h5>
                        </div>
                    @endif
                </a>
            </div>
            @endforeach
        </div>
    </div>
</div>

@endsection
