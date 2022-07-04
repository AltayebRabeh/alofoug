@extends('layouts.backend.admin')


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
                        <li class="breadcrumb-item active">إضافة
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="content-body">

        <section id="basic-form-layouts">
            <div class="row match-height">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-name cairo" id="basic-layout-form">صفحة الـ PDF</h4>
                            <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                            <div class="heading-elements">
                                <ul class="list-inline mb-0">
                                    <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="card-content collapse show">
                            <div class="card-body">
                                <form class="form" action="{{ route('pdf.pages.store') }}" method="POST">
                                    @csrf
                                    <div class="form-body">
                                        <div class="form-group">
                                            <label for="name">إسم الصفحة بالعربي</label>
                                            <input type="text" id="name" class="form-control" value="{{ old('name') }}" placeholder="إسم الصفحة بالعربي" name="name">
                                            @error('name')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="name_en">إسم الصفحة بالانجليزي</label>
                                            <input type="text" id="name_en" class="form-control" value="{{ old('name_en') }}" placeholder="إسم الصفحة بالانجليزي" name="name_en">
                                            @error('name_en')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="lfm">ملف الـ PDF بالعربي</label>

                                            <div class="input-group">
                                                <a id="lfm" data-input="pdf" data-preview="holder" class="btn btn-primary">
                                                    <i class="fa fa-picture-o"></i> إختيار
                                                </a>
                                                <input id="pdf" value="{{old('pdf')}}" readonly class="form-control" type="text" name="pdf">
                                            </div>
                                            @error('pdf')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="lfm_en">ملف الـ PDF بالانجليزي</label>

                                            <div class="input-group">
                                                <a id="lfm_en" data-input="pdf_en" data-preview="holder" class="btn btn-primary">
                                                    <i class="fa fa-picture-o"></i> إختيار
                                                </a>
                                                <input id="pdf_en" value="{{old('pdf_en')}}" readonly class="form-control" type="text" name="pdf_en">
                                            </div>
                                            @error('pdf_en')
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

<script src="{{ asset('vendor/laravel-filemanager/js/stand-alone-button.js') }}"></script>
<script>
    $('#lfm').filemanager('pdf');
    $('#lfm_en').filemanager('pdf');
</script>

<script>
    $(document).ready(function(){

      // Define function to open filemanager window
      var lfm = function(options, cb) {
        var route_prefix = (options && options.prefix) ? options.prefix : '/laravel-filemanager';
        window.open(route_prefix + '?type=' + options.type || 'file', 'FileManager', 'width=900,height=600');
        window.SetUrl = cb;
      };

    });
  </script>
@endsection
