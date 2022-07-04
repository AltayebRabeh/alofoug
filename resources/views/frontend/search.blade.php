@extends('layouts.frontend.app')

@section('content')

<div class="page mb-4">
    <div class="container">
        <div class="text-center">
            <h1 class="h3 mb-5 center-title">{{ __('Search Results') }}</h1>
        </div>
        @if ($searchResults->first())
            <table class="table">
                @foreach ($searchResults as $result)
                    <tr>
                        <td><a href="{{ $result->url }}">{{ $result->title }}</a></td>
                    </tr>
                @endforeach
            </table>
        @else
            <p class="text-center">{{ __('No Results') }}</p>
        @endif
    </div>
</div>

@endsection
