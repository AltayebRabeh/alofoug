@extends('layouts.backend.admin')

@section('content')
<div class="content-wrapper">

    <div class="description-body">

        <section id="basic-form-layouts">
            <div class="row match-height">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title cairo" id="basic-layout-form">الملف الشخصي</h4>
                            <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                        </div>
                        <div class="card-description collapse show">
                            <div class="card-body">
                                <form class="form" action="{{ route('profile.edit.info') }}" method="POST">
                                    @csrf
                                    <div class="form-body">
                                        <div class="form-group">
                                            <label for="name">الاسم</label>
                                            <input type="text" id="name" class="form-control" value="{{ old('name', $user->name) }}" placeholder="الاسم" name="name">
                                            @error('name')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="email">البريد الالكتروني</label>
                                            <input type="email" id="email" class="form-control " value="{{ old('email', $user->email) }}" placeholder="البريد الالكتروني" name="email">
                                            @error('email')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-actions">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="la la-check-square-o"></i> تحديث
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title cairo" id="basic-layout-form">تحديث كلمة المرور</h4>
                            <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                        </div>
                        <div class="card-description collapse show">
                            <div class="card-body">
                                <form class="form" action="{{ route('profile.edit.password') }}" method="POST">
                                    @csrf
                                    <div class="form-body">
                                        <div class="form-group">
                                            <label for="old_password">كلمة المرور القديمة</label>
                                            <input type="password" id="old_password" class="form-control" placeholder="كلمة المرور القديمة" name="old_password">
                                            @error('old_password')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="password">كلمة المرور الجديدة</label>
                                            <input type="password" id="password" class="form-control" value="{{ old('password') }}" placeholder="كلمة المرور الجديدة" name="password">
                                            @error('password')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="password_confirmation">تأكيد كلمة المرور</label>
                                            <input type="password" id="password_confirmation" class="form-control" value="{{ old('password_confirmation') }}" placeholder="تأكيد كلمة المرور" name="password_confirmation">
                                            @error('password_confirmation')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-actions">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="la la-check-square-o"></i> تحديث
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title cairo" id="basic-layout-form">الصلاحيات</h4>
                            <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                        </div>
                        <div class="card-description collapse show">
                            <div class="card-body">
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
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </div>
</div>

@endsection
