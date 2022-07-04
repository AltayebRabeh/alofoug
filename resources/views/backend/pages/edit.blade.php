@extends('layouts.backend.admin')

@section('css')

<link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.3/summernote.css" rel="stylesheet">

@endsection

@section('content')
<div class="content-wrapper">
    <div class="content-header row">
        <div class="content-header-left col-md-6 col-12 mb-2">
            <h3 class="content-header-name mb-0 cairo">الصفحات</h3>
            <div class="row breadcrumbs-top">
                <div class="breadcrumb-wrapper col-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">لوحة التحكم</a>
                        </li>
                        <li class="breadcrumb-item"><a href="{{ route('pages.index') }}">الصفحات</a>
                        </li>
                        <li class="breadcrumb-item active">تعديل
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
                            <h4 class="card-name cairo" id="basic-layout-form">الصفحة</h4>
                            <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                            <div class="heading-elements">
                                <ul class="list-inline mb-0">
                                    <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="card-content collapse show">
                            <div class="card-body">
                                <form class="form" action="{{ route('pages.update', $page) }}" method="POST">
                                    @csrf
                                    <div class="form-body">
                                        <div class="form-group">
                                            <label for="name">إسم الصفحة بالعربي</label>
                                            <input type="text" id="name" class="form-control" value="{{ old('name', $page->name) }}" placeholder="إسم الصفحة بالعربي" name="name">
                                            @error('name')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="name_en">إسم الصفحة بالانجليزي</label>
                                            <input type="text" id="name_en" class="form-control" value="{{ old('name_en', $page->getTranslation('name', 'en')) }}" placeholder="إسم الصفحة بالانجليزي" name="name_en">
                                            @error('name_en')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="content">الصفحة بالعربي</label>
                                            <textarea id="content" rows="5" class="form-control" name="content" placeholder="الصفحة"> {{ old('content', $page->content) }}</textarea>
                                            @error('content')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="content_en">الصفحة بالانجليزي</label>
                                            <textarea id="content_en" rows="5" class="form-control" name="content_en" placeholder="الصفحة">{{ old('content_en', $page->getTranslation('content', 'en')) }}</textarea>
                                            @error('content_en')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="lfm">صورة الصفحة</label>

                                            <div class="input-group">
                                                <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary">
                                                    <i class="fa fa-picture-o"></i> إختيار
                                                </a>
                                                <input id="thumbnail" readonly class="form-control" type="text" value="{{ $page->thumbnail }}" name="thumbnail">
                                                <a href="javascript:void()" id="removeThumbnail" class="btn btn-danger"><i class="la la-trash"></i></a>
                                            </div>
                                            <div id="holder" style="margin-top:15px"></div>
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
    $('#lfm').filemanager('image');
</script>

<script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.3/summernote.js"></script>

<script>
    $(document).ready(function(){

        $('#holder').append('<img src="{{ $page->thumbnail }}" style="height: 5rem;">');

        $('#removeThumbnail').click(function() {
            $('#thumbnail').val('');
            $('#holder img').attr('src', '');
        })


      // Define function to open filemanager window
      var lfm = function(options, cb) {
        var route_prefix = (options && options.prefix) ? options.prefix : '/laravel-filemanager';
        window.open(route_prefix + '?type=' + options.type || 'file', 'FileManager', 'width=900,height=600');
        window.SetUrl = cb;
      };

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
      $('#content').summernote({
        placeholder: 'الصفحة بالعربي',
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

      $('#content_en').summernote({
        placeholder: 'الصفحة بالانجليزي',
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
