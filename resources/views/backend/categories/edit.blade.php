@extends('layouts.backend.admin')

@section('content')
<div class="content-wrapper">
    <div class="description-header row">
        <div class="description-header-left col-md-6 col-12 mb-2">
            <h3 class="description-header-title mb-0 cairo">التصنيفات</h3>
            <div class="row breadcrumbs-top">
                <div class="breadcrumb-wrapper col-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">لوحة التحكم</a>
                        </li>
                        <li class="breadcrumb-item"><a href="{{ route('categories.index') }}">التصنيفات</a>
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
                            <h4 class="card-title cairo" id="basic-layout-form">تفاصيل التصنيف</h4>
                            <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                            <div class="heading-elements">
                                <ul class="list-inline mb-0">
                                    <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="card-description collapse show">
                            <div class="card-body">
                                <form class="form" action="{{ route('categories.update', $category) }}" method="POST">
                                    @csrf
                                    <div class="form-body">
                                        <div class="row">
                                            <div class="col-md-6 col-lg-6">
                                                <div class="form-group">
                                                    <label for="name">الاسم بالعربي</label>
                                                    <input type="text" id="name" class="form-control" value="{{ old('name', $category->name) }}" placeholder="الاسم بالعربي" name="name">
                                                    @error('name')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-lg-6">
                                                <div class="form-group">
                                                    <label for="name_en">الاسم بالانجليزي</label>
                                                    <input type="text" id="name_en" class="form-control " value="{{ old('name_en', $category->getTranslation('name', 'en')) }}" placeholder="الاسم بالانجليزي" name="name_en">
                                                    @error('name_en')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="description">الوصف</label>
                                            <textarea id="description" rows="5" class="form-control" name="description" placeholder="الوصف"> {{ old('description', $category->description) }}</textarea>
                                            @error('description')
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
