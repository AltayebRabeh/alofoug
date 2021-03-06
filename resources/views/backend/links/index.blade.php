@extends('layouts.backend.admin')

@section('content')
<div class="content-wrapper">
    <div class="content-header row">
        <div class="content-header-left col-md-6 col-12 mb-2">
            <h3 class="content-header-title mb-0 cairo">الروابط</h3>
            <div class="row breadcrumbs-top">
                <div class="breadcrumb-wrapper col-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">لوحة التحكم</a>
                        </li>
                        <li class="breadcrumb-item active">الروابط
                        </li>
                    </ol>
                </div>
            </div>
        </div>
        <div class="content-header-right text-md-right col-md-6 col-12">
            <div class="btn-group">
                <button class="btn btn-round btn-info" type="button" data-toggle="modal" data-target="#addlink"><i class="icon-cog3"></i> إضافة رابط</button>
            </div>
        </div>
    </div>

    @error('name')
        <span class="text-danger d-block">{{ $message }}</span>
    @enderror

    @error('name_en')
        <span class="text-danger d-block">{{ $message }}</span>
    @enderror

    @error('url')
        <span class="text-danger d-block">{{ $message }}</span>
    @enderror


    <div class="content-body">

        <div class="row" id="default">
            <div class="col-12">
              <div class="card">
                <div class="card-header">
                  <h4 class="card-title cairo">الروابط</h4>
                  <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                  <div class="heading-elements">
                    <ul class="list-inline mb-0">
                      <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                    </ul>
                  </div>
                </div>
                <div class="card-content collapse show">
                  <div class="table-responsive">
                    <table class="table mb-0">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>إسم الرابط</th>
                          <th>عنوان الرابط</th>
                          <th>التاريخ</th>
                          <th>العمليات</th>
                        </tr>
                      </thead>
                      <tbody>
                        @forelse ($links as $link)
                            <tr>
                                <td>{{ $link->id }}</td>
                                <td>{{ $link->name }}</td>
                                <td><a href="{{ $link->url }}">{{ $link->url }}</a></td>
                                <td>{{ $link->created_at }}</td>
                                <td>
                                    <div class="btn-group">
                                        <button class="btn btn-info btn-sm"  data-toggle="modal" data-target="#edit-{{$link->id}}"><i class="la la-pencil"></i></button>
                                        @if (!$link->primary)
                                            <button data-action="{{ route('links.destroy', $link) }}" type="button" class="btn btn-danger btn-sm delete-btn" data-toggle="modal" data-target="#deleteModal">
                                                <i class="la la-trash"></i>
                                            </button>
                                        @endif

                                        <button class="btn btn-primary btn-sm"  data-toggle="modal" data-target="#addToMainMenu-{{$link->id}}">إضافة إلى القائمة الرئيسية</button>
                                        <button class="btn btn-success btn-sm"  data-toggle="modal" data-target="#addToUnderMenu-{{$link->id}}">إضافة إلى القائمة السفلية</button>
                                    </div>
                                </td>
                            </tr>

                            @include('backend.links.add_to_main_menu')
                            @include('backend.links.add_to_under_menu')

                            @include('backend.links.edit_link')

                        @empty
                            <tr>
                                <td colspan="5" class="text-center">لاتوجد سجلات لعرضها</td>
                            </tr>
                        @endforelse
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>

              @include('backend.links.main_links')

              @include('backend.links.under_links')

            </div>
          </div>
    </div>
</div>

    @include('backend.links.add_link')

    @include('layouts.backend.modal.delete')


    @endsection

@section('js')

<script>

    $('.delete-btn').click(function() {
        $('#deleteModal form').attr('action', $(this).data('action'))
    });

</script>

@endsection
