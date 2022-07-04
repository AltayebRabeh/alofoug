@extends('layouts.backend.admin')

@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('backend/vendors/css/forms/selects/select2.min.css') }}">

<link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.3/summernote.css" rel="stylesheet">

@endsection

@section('content')
<div class="content-wrapper">
    <div class="content-header row">
        <div class="content-header-left col-md-6 col-12 mb-2">
            <h3 class="content-header-name mb-0 cairo">البرامج</h3>
            <div class="row breadcrumbs-top">
                <div class="breadcrumb-wrapper col-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">لوحة التحكم</a>
                        </li>
                        <li class="breadcrumb-item"><a href="{{ route('programs.index') }}">البرامج</a>
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
                            <h4 class="card-name cairo" id="basic-layout-form">إضافة برنامج</h4>
                            <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                            <div class="heading-elements">
                                <ul class="list-inline mb-0">
                                    <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="card-description collapse show">
                            <div class="card-body">
                                <form class="form" action="{{ route('programs.store') }}" method="POST">
                                    @csrf
                                    <div class="form-body">

                                        <div class="form-group">
                                            <label for="name">إسم البرنامج بالعربي</label>
                                            <input type="text" id="name" class="form-control" value="{{ old('name') }}" placeholder="إسم البرنامج بالعربي" name="name">
                                            @error('name')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="name_en">إسم البرنامج بالانجليزي</label>
                                            <input type="text" id="name_en" class="form-control" value="{{ old('name_en') }}" placeholder="إسم البرنامج بالانجليزي" name="name_en">
                                            @error('name_en')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="description">وصف البرنامج بالعربي</label>
                                            <textarea id="description" rows="5" class="form-control" name="description" placeholder="وصف البرنامج"> {{ old('description') }}</textarea>
                                            @error('description')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="description_en">وصف البرنامج بالانجليزي</label>
                                            <textarea id="description_en" rows="5" class="form-control" name="description_en" placeholder="وصف البرنامج">{{ old('description_en') }}</textarea>
                                            @error('description_en')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="classrooms">الفصول</label>
                                            <select class="select2 form-control" id="classrooms" multiple="multiple" name="classrooms[]">
                                                @foreach ($classrooms as $classroom)
                                                    <option value="{{ $classroom->id }}">{{ $classroom->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('classrooms')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="lfm">صورة للبرنامج</label>

                                            <div class="input-group">
                                                <a id="lfm" data-input="image" data-preview="holder" class="btn btn-primary">
                                                    <i class="fa fa-picture-o"></i> إختيار
                                                </a>
                                                <input id="image" readonly class="form-control" type="text" name="image">
                                                <a href="javascript:void()" id="removeImage" class="btn btn-danger"><i class="la la-trash"></i></a>
                                            </div>
                                            <div id="holder" style="margin-top:15px"></div>
                                        </div>

                                        <div class="form-group">
                                            <label for="e_learning_url">رابط التعليم الالكتروني</label>
                                            <input type="url" id="e_learning_url" class="form-control" value="{{ old('e_learning_url') }}" placeholder="رابط التعليم الالكتروني" name="e_learning_url">
                                            @error('e_learning_url')
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


<script src="{{ asset('vendor/laravel-filemanager/js/stand-alone-button.js') }}"></script>
<script>
    $('#lfm').filemanager('image');
</script>

<script>
    $(document).ready(function(){


    $('#removeImage').click(function() {
        $('#image').val('');
        $('#holder img').attr('src', '');
    })

    // Define LFM summernote button
      var LFMButton = function(context) {
        var ui = $.summernote.ui;
        var button = ui.button({
          contents: '<i class="note-icon-picture"></i> ',
          tooltip: 'Insert image with filemanager',
          click: function() {

            lfm({type: 'image', prefix: '/laravel-filemanager'}, function(lfmItems, path) {
              lfmItems.forEach(function (lfmItem) {
                context.invoke('insertImage', lfmItem.url);
              });
            });

          }
        });
        return button.render();
      };

      // Initialize summernote with LFM button in the popover button group
      // Please note that you can add this button to any other button group you'd like
      $('#description').summernote({
        placeholder: 'وصف البرنامج بالعربي',
        tabsize: 2,
        height: 200,
        lang: 'ar-AR',
        toolbar: [
            ['style', ['style']],
            ['font', ['bold','underline','clear']],
            ['fontname', ['fontname']],
            ['color', ['color']],
            ['para', ['ul','ol','paragraph']],
            ['table', ['table']],
            ['insert', ['link', 'lfm','video']],
            ['view', ['fullscreen','codeview','help']],
        ],
        buttons: {
          lfm: LFMButton
        }
      });

      $('#description_en').summernote({
        placeholder: 'وصف البرنامج بالانجليزي',
        tabsize: 2,
        height: 200,
        lang: 'ar-AR',
        toolbar: [
            ['style', ['style']],
            ['font', ['bold','underline','clear']],
            ['fontname', ['fontname']],
            ['color', ['color']],
            ['para', ['ul','ol','paragraph']],
            ['table', ['table']],
            ['insert', ['link', 'lfm','video']],
            ['view', ['fullscreen','codeview','help']],
        ],
        buttons: {
          lfm: LFMButton
        }
      })
    });
  </script>
@endsection
