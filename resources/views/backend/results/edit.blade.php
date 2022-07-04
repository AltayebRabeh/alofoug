@extends('layouts.backend.admin')

@section('css')

<link rel="stylesheet" type="text/css" href="{{ asset('backend/vendors/css/forms/selects/select2.min.css') }}">
<link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.3/summernote.css" rel="stylesheet">

@endsection

@section('content')
<div class="content-wrapper">
    <div class="description-header row">
        <div class="description-header-left col-md-6 col-12 mb-2">
            <h3 class="description-header-title mb-0 cairo">النتائج</h3>
            <div class="row breadcrumbs-top">
                <div class="breadcrumb-wrapper col-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">لوحة التحكم</a>
                        </li>
                        <li class="breadcrumb-item"><a href="{{ route('results.index') }}">النتائج</a>
                        </li>
                        <li class="breadcrumb-item active">تعديل
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="description-body">

        <section id="basic-form-layouts">
            <div class="row match-height">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title cairo" id="basic-layout-form">تعديل نتيجة</h4>
                            <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                            <div class="heading-elements">
                                <ul class="list-inline mb-0">
                                    <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="card-description collapse show">
                            <div class="card-body">
                                <form class="form" action="{{ route('results.update', $result) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-body">

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="program">البرنامج</label>
                                                    <select name="program" id="program" class="select2 form-control">
                                                        <option></option>
                                                        @foreach ($programs as $program)
                                                            <option value="{{ $program->id }}" {{ $program->id == $result->program_id ? 'selected' : '' }}>{{ $program->name }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('program')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="classroom">الفصل</label>
                                                    <select name="classroom" id="classroom" class="select2 form-control">
                                                        @foreach ($result->program->classrooms as $classroom)
                                                            <option value="{{ $classroom->id }}" {{ $classroom->id == $result->classroom_id ? 'selected' : '' }}>{{ $classroom->name }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('classroom')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="excel">ملف النتيجة</label>
                                                    <input type="file" name="excel" id="excel" class="form-control">
                                                    @error('excel')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="end_date">تاريخ حذف النتيجة</label>
                                                    <input type="date" name="end_date" value="{{$result->end_date}}" id="end_date" class="form-control">
                                                    @error('end_date')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="description">الوصف بالعربي</label>
                                            <textarea id="description" rows="5" class="form-control" name="description"> {{ old('description', $result->description) }}</textarea>
                                            @error('description')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="description_en">الوصف بالانجليزي</label>
                                            <textarea id="description_en" rows="5" class="form-control" name="description_en"> {{ old('description_en',$result->getTranslation('description', 'en')) }}</textarea>
                                            @error('description_en')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                    </div>
                                    <div class="form-actions">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="la la-check-square-o"></i> حفظ
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </div>
</div>

@endsection


@section('js')

<script src="{{ asset('backend/vendors/js/forms/select/select2.full.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('backend/js/scripts/forms/select/form-select2.js') }}" type="text/javascript"></script>

<script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.3/summernote.js"></script>

<script>
    $(document).ready(function(){

      // Initialize summernote with LFM button in the popover button group
      // Please note that you can add this button to any other button group you'd like
      $('#description').summernote({
        placeholder: 'وصف النتيجة بالعربي',
        tabsize: 2,
        height: 200,
      });

      $('#description_en').summernote({
        placeholder: 'وصف النتيجة بالانجليزي',
        tabsize: 2,
        height: 200,
      });

    });

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


  </script>
@endsection
