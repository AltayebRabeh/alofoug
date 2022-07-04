@extends('layouts.backend.admin')

@section('content')
<div class="content-wrapper">
    <div class="content-header row">
        <div class="content-header-left col-md-6 col-12 mb-2">
            <h3 class="content-header-title mb-0 cairo">البرامج</h3>
            <div class="row breadcrumbs-top">
                <div class="breadcrumb-wrapper col-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">لوحة التحكم</a>
                        </li>
                        <li class="breadcrumb-item active">البرامج
                        </li>
                    </ol>
                </div>
            </div>
        </div>
        <div class="content-header-right text-md-right col-md-6 col-12">
            <div class="btn-group">
                <a href="{{ route('programs.create') }}" class="btn btn-round btn-info" type="button"><i class="icon-cog3"></i> إضافة برنامج</a>
            </div>
        </div>
    </div>

    <div class="content-body">

        <div class="row" id="default">
            <div class="col-12">
              <div class="card">
                <div class="card-header">
                  <h4 class="card-title cairo">البرامج</h4>
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
                          <th>إسم البرنامج</th>
                          <th>رابط التعليم الالكتروني</th>
                          <th>الفصول</th>
                          <th>التاريخ</th>
                          <th>العمليات</th>
                        </tr>
                      </thead>
                      <tbody>
                        @forelse ($programs as $program)
                            <tr>
                                <td>{{ $program->id }}</td>
                                <td>{{ $program->name }}</td>
                                <td><a href="{{ $program->e_learning_url }}" target="_blank" rel="noopener noreferrer">{{ $program->e_learning_url }}</a></td>
                                <td>
                                    @forelse ($program->classrooms as $classroom)
                                        <span class="badge badge-info">{{ $classroom->name }}</span>
                                    @empty
                                        لاتوجد صفوف
                                    @endforelse
                                </td>
                                <td>{{ $program->created_at }}</td>
                                <td>
                                    <div class="btn-group">
                                        <a href="{{ route('programs.edit', $program) }}" class="btn btn-success btn-sm"><i class="la la-pencil"></i></a>
                                        <a href="{{ route('programs.show', $program) }}" class="btn btn-info btn-sm"><i class="la la-eye"></i></a>
                                        <button data-action="{{ route('programs.destroy', $program) }}" type="button" class="btn btn-danger btn-sm delete-btn" data-toggle="modal" data-target="#deleteModal">
                                            <i class="la la-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">لاتوجد سجلات لعرضها</td>
                            </tr>
                        @endforelse
                      </tbody>
                    </table>
                  </div>
                </div>
                <div class="card-footer">
                    {!! $programs->links() !!}
                </div>
              </div>
            </div>
          </div>
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
