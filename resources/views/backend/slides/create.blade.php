@extends('layouts.backend.admin')


@section('content')
<div class="content-wrapper">
    <div class="description-header row">
        <div class="description-header-left col-md-6 col-12 mb-2">
            <h3 class="description-header-name mb-0 cairo">الشريط المتحرك</h3>
            <div class="row breadcrumbs-top">
                <div class="breadcrumb-wrapper col-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">لوحة التحكم</a>
                        </li>
                        <li class="breadcrumb-item"><a href="{{ route('slides.index') }}">الشريط المتحرك</a>
                        </li>
                        <li class="breadcrumb-item active">إضافة
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
                            <h4 class="card-name cairo" id="basic-layout-form">محتوى الشريط</h4>
                            <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                            <div class="heading-elements">
                                <ul class="list-inline mb-0">
                                    <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="card-description collapse show">
                            <div class="card-body">
                                <form class="form" action="{{ route('slides.store') }}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <label for="lfm">صورة الشريط *</label>
                                        <div class="input-group">
                                            <a id="lfm" data-input="image" data-preview="holder" class="btn btn-primary">
                                                <i class="fa fa-picture-o"></i> إختيار
                                            </a>
                                            <input id="image" readonly class="form-control" type="text" name="image">
                                            <a href="javascript:void()" id="removeThumbnail" class="btn btn-danger"><i class="la la-trash"></i></a>
                                        </div>
                                        <div id="holder" style="margin-top:15px"></div>
                                        @error('image')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-body">
                                        <div class="form-group">
                                            <label for="title">عنوان الشريط بالعربي</label>
                                            <input type="text" id="title" class="form-control" value="{{ old('title') }}" placeholder="عنوان الشريط بالعربي" name="title">
                                            @error('title')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="title_en">عنوان الشريط بالانجليزي</label>
                                            <input type="text" id="title_en" class="form-control" value="{{ old('title_en') }}" placeholder="عنوان الشريط بالانجليزي" name="title_en">
                                            @error('title_en')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="description">وصف الشريط بالعربي</label>
                                            <textarea id="description" rows="5" class="form-control" name="description" placeholder="وصف الشريط"> {{ old('description') }}</textarea>
                                            @error('description')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="description_en">وصف الشريط بالانجليزي</label>
                                            <textarea id="description_en" rows="5" class="form-control" name="description_en" placeholder="وصف الشريط">{{ old('description_en') }}</textarea>
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

<script src="{{ asset('vendor/laravel-filemanager/js/stand-alone-button.js') }}"></script>
<script>
    $('#lfm').filemanager('image');
</script>

<script>
    $(document).ready(function(){

    $('#removeThumbnail').click(function() {
        $('#image').val('');
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
    });
  </script>
@endsection
