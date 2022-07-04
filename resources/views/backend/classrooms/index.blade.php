@extends('layouts.backend.admin')

@section('content')
<div class="content-wrapper">
    <div class="content-header row">
        <div class="content-header-left col-md-6 col-12 mb-2">
            <h3 class="content-header-title mb-0 cairo">الفصول الدراسية</h3>
            <div class="row breadcrumbs-top">
                <div class="breadcrumb-wrapper col-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">لوحة التحكم</a>
                        </li>
                        <li class="breadcrumb-item active">الفصول الدراسية
                        </li>
                    </ol>
                </div>
            </div>
        </div>
        <div class="content-header-right text-md-right col-md-6 col-12">
            <div class="btn-group">
                <button class="btn btn-round btn-info" type="button" data-toggle="modal" data-target="#addClassroom"><i class="icon-cog3"></i> إضافة فصل دراسي</button>
            </div>
        </div>
    </div>

    <div class="content-body">

        <div class="row" id="default">
            <div class="col-12">
              <div class="card">
                <div class="card-header">
                  <h4 class="card-title cairo">الفصول الدراسية</h4>
                  <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                  <div class="heading-elements">
                    <ul class="list-inline mb-0">
                      <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                    </ul>
                  </div>
                </div>
                <div class="card-content collapse show">
                    @error('name')
                        <span class="error">{{ $message }}</span>
                    @enderror
                  <div class="table-responsive">
                    <table class="table mb-0">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>الفصل الدراسي</th>
                          <th>العمليات</th>
                        </tr>
                      </thead>
                      <tbody>
                        @forelse ($classrooms as $classroom)
                            <tr>
                                <td>{{ $classroom->id }}</td>
                                <td>{{ $classroom->name }}</td>
                                <td>
                                    <div class="btn-group">
                                        <button class="btn btn-success btn-sm"  data-toggle="modal" data-target="#edit-{{$classroom->id}}"><i class="la la-pencil"></i></button>
                                        <button data-action="{{ route('classrooms.destroy', $classroom) }}" type="button" class="btn btn-danger btn-sm delete-btn" data-toggle="modal" data-target="#deleteModal">
                                            <i class="la la-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>

                            <div class="modal fade text-left" id="edit-{{$classroom->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" style="display: none;" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <form action="{{ route('classrooms.update', $classroom) }}" method="POST">
                                        @csrf
                                        <div class="modal-content">
                                            <div class="modal-header">
                                            <h4 class="modal-title" id="myModalLabel1">تعديل فصل دراسي</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label for="name">إسم الفصل بالعربي</label>
                                                    <input type="text" name="name" value="{{ old('name', $classroom->name) }}" id="name" class="form-control">
                                                </div>

                                                <div class="form-group">
                                                    <label for="name_en">إسم الفصل بالانجليزي</label>
                                                    <input type="text" name="name_en" value="{{ old('name', $classroom->getTranslation('name', 'en')) }}" id="name_en" class="form-control">
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                            <button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal">إغلاق</button>
                                            <button type="submit" class="btn btn-outline-primary">حفظ</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                              </div>

                        @empty
                            <tr>
                                <td colspan="5" class="text-center">لاتوجد سجلات لعرضها</td>
                            </tr>
                        @endforelse
                      </tbody>
                    </table>
                  </div>
                </div>
                <div class="card-footer">
                    {!! $classrooms->links() !!}
                </div>
              </div>
            </div>
          </div>
    </div>
</div>

<div class="modal fade text-left" id="addClassroom" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" style="display: none;" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action="{{ route('classrooms.store') }}" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel1">إضافة فصل دراسي</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">إسم الفصل بالعربي</label>
                        <input type="text" name="name" value="{{ old('name') }}" id="name" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="name_en">إسم الفصل بالانجليزي</label>
                        <input type="text" name="name_en" value="{{ old('name_en') }}" id="name_en" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                <button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal">إغلاق</button>
                <button type="submit" class="btn btn-outline-primary">حفظ</button>
                </div>
            </div>
        </form>
    </div>
  </div>

    @include('layouts.backend.modal.delete')

@endsection

@section('js')

<script>

    $('.delete-btn').click(function() {
        $('#deleteModal form').attr('action', $(this).data('action'))
    });

</script>

@endsection
