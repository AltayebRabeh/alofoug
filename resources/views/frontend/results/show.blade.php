@extends('layouts.frontend.app')

@section('content')

<div class="news">
    <div class="container">
        <div class="text-center">
            <h3 class="h3 mb-5 center-title">{{ __('View Student Result') }}</h3>
            <p>{!! $result->description !!}</p>
        </div>
        <table class="table">
            @foreach ($data as $key => $value)
                <tr>
                    <th>{{ $key }}</th>
                    @if(gettype($value) == 'double')
                        <td>{{ number_format($value, 2) }}</td>
                    @else
                        <td>{{ $value }}</td>
                    @endif
                </tr>
            @endforeach
        </table>
    </div>
</div>

@endsection
