@extends('layouts.backend.admin')

@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('backend/vendors/css/forms/selects/select2.min.css') }}">

@endsection

@section('content')
<div class="content-wrapper">
    <div class="content-header row">
        <div class="content-header-left col-md-6 col-12 mb-2">
            <h3 class="content-header-name mb-0 cairo">المستخدمين</h3>
            <div class="row breadcrumbs-top">
                <div class="breadcrumb-wrapper col-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">لوحة التحكم</a>
                        </li>
                        <li class="breadcrumb-item"><a href="{{ route('users.index') }}">المستخدمين</a>
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
                            <h4 class="card-name cairo" id="basic-layout-form">إضافة مستخدم</h4>
                            <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                            <div class="heading-elements">
                                <ul class="list-inline mb-0">
                                    <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="card-description collapse show">
                            <div class="card-body">
                                <form class="form" action="{{ route('users.store') }}" method="POST">
                                    @csrf
                                    <div class="form-body">

                                        <div class="form-group">
                                            <label for="name">إسم المستخدم</label>
                                            <input type="text" id="name" class="form-control" value="{{ old('name') }}" placeholder="إسم المستخدم" name="name">
                                            @error('name')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="email">البريد الالكتروني</label>
                                            <input type="email" id="email" class="form-control" value="{{ old('email') }}" placeholder="البريد الالكتروني" name="email">
                                            @error('email')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="password">كلمة المرور</label>
                                            <input type="password" id="password" class="form-control" value="{{ old('password') }}" placeholder="كلمة المرور" name="password">
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

                                        <div class="form-group">
                                            <label for="permissions">الصلاحيات</label>
                                            <select name="permissions[]" id="permissions" class="select2 form-control" multiple>
                                                @foreach ($permissions as $permision)
                                                    <option value="{{ $permision->id }}">{{ $permision->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('permissions')
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

@endsection
