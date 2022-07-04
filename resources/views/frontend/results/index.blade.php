@extends('layouts.frontend.app')

@section('title')
{{ __('Results') }}
@endsection

@section('description')
{{ $cache_settings ? $cache_settings->bio : '' }}
@endsection

@section('url')
{{ route('results') }}
@endsection

@section('image')
{{ $cache_settings ? $cache_settings->min_logo : '' }}
@endsection

@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('backend/vendors/css/forms/selects/select2.min.css') }}">
@endsection

@section('content')

<div class="news">
    <div class="container">
        <div class="text-center">
            <h3 class="h3 mb-5 center-title">{{ __('Results') }}</h3>
        </div>
        <form action="{{ route('your.result') }}" method="get">
            @csrf
            <div class="row my-5 pb-4">
                <div class="col-md-12  pb-2">
                    <div class="form-group">
                        <label for="program">{{ __('Choose The Program') }}</label>
                        <select class="select2 form-control" name="program" id="program">
                            <option></option>
                            @foreach ($programs as $program)
                                <option value="{{ $program->id }}">{{ $program->name }}</option>
                            @endforeach
                        </select>
                        @error('program')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-12 pb-2">
                    <div class="form-group">
                        <label for="classroom">{{ __('Choose Class') }}</label>
                        <select class="form-control" name="classroom" id="classroom">
                        </select>
                        @error('classroom')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-12  pb-2">
                    <div class="form-group">
                        <label for="student_number">{{ __('Student Number') }}</label>
                        <input type="text" class="form-control" value="{{ old('student_number') }}" name="student_number" id="student_number">
                        @error('student_number')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="input-group">
                    <input type="submit" value="{{ __('Show') }}" class="btn btn-primary d-block">
                </div>
            </div>
        </form>
    </div>
</div>

@endsection

@section('js')

<script
  src="https://code.jquery.com/jquery-3.6.0.min.js"
  integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
  crossorigin="anonymous"></script>

<script src="{{ asset('backend/vendors/js/forms/select/select2.full.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('backend/js/scripts/forms/select/form-select2.js') }}" type="text/javascript"></script>

<script>
    $(document).ready(function(){

        $('#program').change(function() {

            var id = $(this).val();
            var url = '{{ route("programs.get.classrooms.for.program", ":id") }}';
            url = url.replace(':id', id);

            $.ajax({
                type: "get",
                url: url,
                success: function(data){
                    $('#classroom').find('option').remove();
                    $.each(data,function(key, value)
                    {
                        $('#classroom').append('<option value=' + key + '>' + value + '</option>'); // return empty
                    });
                },
                error: function(error) {
                    console.log(error);
                }
            });

        });

    });


  </script>

    @include('sweetalert::alert', ['cdn' => "https://cdn.jsdelivr.net/npm/sweetalert2@9"])

@endsection
