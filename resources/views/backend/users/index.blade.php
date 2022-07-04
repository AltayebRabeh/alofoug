@extends('layouts.backend.admin')

@section('content')
<div class="content-wrapper">
    <div class="content-header row">
        <div class="content-header-left col-md-6 col-12 mb-2">
            <h3 class="content-header-title mb-0 cairo">المستخدمين</h3>
            <div class="row breadcrumbs-top">
                <div class="breadcrumb-wrapper col-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">لوحة التحكم</a>
                        </li>
                        <li class="breadcrumb-item active">المستخدمين
                        </li>
                    </ol>
                </div>
            </div>
        </div>
        <div class="content-header-right text-md-right col-md-6 col-12">
            <div class="btn-group">
                <a href="{{ route('users.create') }}" class="btn btn-round btn-info" type="button"><i class="icon-cog3"></i> إضافة مستخدم</a>
            </div>
        </div>
    </div>

    <div class="content-body">

        <div class="row" id="default">
            <div class="col-12">
              <div class="card">
                <div class="card-header">
                  <h4 class="card-title cairo">المستخدمين</h4>
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
                          <th>إسم المستخدم</th>
                          <th>البريد الالكتروني</th>
                          <th>الصلاحيات</th>
                          <th>التاريخ</th>
                          <th>العمليات</th>
                        </tr>
                      </thead>
                      <tbody>
                        @forelse ($users as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    @if ($user->roles->first())
                                        @foreach ($user->roles as $role)
                                            <span class="badge badge-danger">{{ $role->name }}</span>
                                        @endforeach
                                    @elseif ($user->permissions->first())
                                        @foreach ($user->permissions as $permission)
                                            <span class="badge badge-success">{{ $permission->name }}</span>
                                        @endforeach
                                    @else
                                        <span>لاتوجد صلاحيات</span>
                                    @endif
                                </td>
                                <td>{{ $user->created_at }}</td>
                                <td>
                                    @if(!$user->roles->first())
                                        <div class="btn-group">
                                            <a href="{{ route('users.edit', $user) }}" class="btn btn-success btn-sm"><i class="la la-pencil"></i></a>
                                            <button data-action="{{ route('users.destroy', $user) }}" type="button" class="btn btn-danger btn-sm delete-btn" data-toggle="modal" data-target="#deleteModal">
                                                <i class="la la-trash"></i>
                                            </button>
                                        </div>
                                    @endif
                                </td>
                            </tr>
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
                    {!! $users->links() !!}
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
