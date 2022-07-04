@extends('layouts.backend.admin')

@section('css')

<link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.3/summernote.css" rel="stylesheet">

@endsection

@section('content')

<div class="content-wrapper">
    <div class="description-header row">
        <div class="description-header-left col-md-6 col-12 mb-2">
            <h3 class="description-header-name mb-0 cairo">المراسلات</h3>
            <div class="row breadcrumbs-top">
                <div class="breadcrumb-wrapper col-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">لوحة التحكم</a>
                        </li>
                        <li class="breadcrumb-item"><a href="{{ route('contacts.index') }}">المراسلات</a>
                        </li>
                        <li class="breadcrumb-item active">رد
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
                            <h4 class="card-name cairo" id="basic-layout-form">رد على  {{ $contact->name }}</h4>
                            <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                            <div class="heading-elements">
                                <ul class="list-inline mb-0">
                                    <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="card-description collapse show">
                            <div class="card-body">
                                <form class="form" action="{{ route('contacts.send.reply', $contact) }}" method="POST">
                                    @csrf
                                    <div class="form-body">

                                        <div class="form-group">
                                            <label for="message">الرسالة</label>
                                            <textarea id="message" rows="5" class="form-control" name="message" placeholder="الرسالة"> {{ old('message') }}</textarea>
                                            @error('message')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                    </div>
                                    <div class="form-actions">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="la la-check-square-o"></i> إرسال
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

<script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.3/summernote.js"></script>

<script>

    $(document).ready(function(){

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
      $('#message').summernote({
        placeholder: 'رد على {{ $contact->name }}',
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


    });
  </script>
@endsection
