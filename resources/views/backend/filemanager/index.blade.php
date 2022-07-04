@extends('layouts.backend.admin')

@section('content')

<iframe src="{{ url('laravel-filemanager') }}" style="width: 100%; min-height: 100vh; overflow: hidden; border: none;"></iframe>


@endsection
