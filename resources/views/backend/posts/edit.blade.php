@extends('layouts.backend.admin')

@section('css')

    <link rel="stylesheet" type="text/css" href="{{ asset('backend/vendors/css/forms/toggle/switchery.min.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ asset('backend/vendors/css/forms/selects/select2.min.css') }}">

    <link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.3/summernote.css" rel="stylesheet">

@endsection

@section('content')
<div class="content-wrapper">
    <div class="content-header row">
        <div class="content-header-left col-md-6 col-12 mb-2">
            <h3 class="content-header-title mb-0 cairo">الاحداث | الاخبار</h3>
            <div class="row breadcrumbs-top">
                <div class="breadcrumb-wrapper col-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">لوحة التحكم</a>
                        </li>
                        <li class="breadcrumb-item"><a href="{{ route('posts.index') }}">الاحداث | الاخبار</a>
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
                            <h4 class="card-title cairo" id="basic-layout-form">تفاصيل الحدث | الخبر</h4>
                            <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                            <div class="heading-elements">
                                <ul class="list-inline mb-0">
                                    <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="card-content collapse show">
                            <div class="card-body">
                                <form class="form" action="{{ route('posts.update', $post) }}" method="POST">
                                    @csrf
                                    <div class="form-body">
                                        <div class="form-group">
                                            <label for="title">عنوان الحدث | الخبر بالعربي</label>
                                            <input type="text" id="title" class="form-control" value="{{ old('title', $post->title) }}" placeholder="عنوان الحدث | الخبر بالعربي" name="title">
                                            @error('title')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="title_en">عنوان الحدث | الخبر بالانجليزي</label>
                                            <input type="text" id="title_en" class="form-control" value="{{ old('title_en', $post->getTranslation('title', 'en')) }}" placeholder="عنوان الحدث | الخبر بالانجليزي" name="title_en">
                                            @error('title_en')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="content">تفاصيل الحدث | الخبر بالعربي</label>
                                            <textarea id="content" rows="5" class="form-control" name="content" placeholder="تفاصيل الحدث | الخبر"> {{ old('content', $post->content) }}</textarea>
                                            @error('content')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="content_en">تفاصيل الحدث | الخبر بالانجليزي</label>
                                            <textarea id="content_en" rows="5" class="form-control" name="content_en" placeholder="تفاصيل الحدث | الخبر">{{ old('content_en', $post->getTranslation('content', 'en')) }}</textarea>
                                            @error('content_en')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="categories">التصنيف</label>
                                            <select class="select2 form-control" id="categories" name="categories[]" multiple="multiple">
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}" {{ in_array($category->id, $post->categories->modelKeys()) ? 'selected' : '' }}>{{ $category->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="lfm">صورة او فيديو الحدث | الخبر</label>

                                            <div class="input-group">
                                                <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary">
                                                    <i class="fa fa-picture-o"></i> إختيار
                                                </a>
                                                <input id="thumbnail" readonly class="form-control" type="text" value="{{ $post->thumbnail }}" name="thumbnail">
                                                <a href="javascript:void()" id="removeThumbnail" class="btn btn-danger"><i class="la la-trash"></i></a>
                                            </div>
                                            <div id="holder" style="margin-top:15px">
                                                @if($post->thumbnail)
                                                    @if($post->media_type == 'image')
                                                        <img src="{{ $post->thumbnail }}" style="height: 5rem;">
                                                    @endif
                                                @endif
                                            </div>
                                        </div>

                                        <div class="form-group mt-1">
                                            <input type="checkbox" name="breaking_news" @checked(old('breaking_news', $post->breaking_news)) id="switcherySize1" class="switchery" data-switchery="true">
                                            <label for="switcherySize1" class="font-medium-2 text-bold-600 ml-1">إضافة للاخبار العاجلة</label>
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

<script src="{{ asset('vendor/laravel-filemanager/js/stand-alone-button.js') }}"></script>
<script>
    $('#lfm').filemanager('media');
</script>

<script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.3/summernote.js"></script>

<script src="{{ asset('backend/vendors/js/forms/toggle/bootstrap-switch.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('backend/vendors/js/forms/toggle/bootstrap-checkbox.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('backend/vendors/js/forms/toggle/switchery.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('backend/js/scripts/forms/switch.js') }}" type="text/javascript"></script>


<script>
    $(document).ready(function(){

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
        placeholder: 'تفاصيل الحدث | الخبر بالعربي',
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
        placeholder: 'تفاصيل الحدث | الخبر بالانجليزي',
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
