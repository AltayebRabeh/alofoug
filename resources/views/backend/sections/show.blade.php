@extends('layouts.backend.admin')

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
                        <li class="breadcrumb-item"><a href="{{ route('posts.index') }}">التصنيفات</a>
                        </li>
                        <li class="breadcrumb-item active">عرض
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="content-body">

        <div class="row" id="default">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title cairo">تفاصيل التصنيف</h4>
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                        <div class="heading-elements">
                            <ul class="list-inline mb-0">
                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-content collapse show">
                        <div class="card-body">
                            <h4 class="cairo">إسم التصنيف بالعربي</h4>
                            <p class="card-title">
                                {{ $category->name }}
                            </p>
                            <hr>
                            <h4 class="cairo">اسم التصنيف بالانجليزي</h4>
                            <p class="card-title">
                                {{ $category->getTranslation('name', 'en') }}
                            </p>
                            <hr>
                            <h4 class="cairo">وصف التصنيف</h4>
                            <p class="card-text">
                                {{ $category->description }}
                            </p>
                            <hr>
                            <h4 class="cairo">التاريخ</h4>
                            <p class="card-text">
                                {{ $category->created_at }}
                            </p>
                            <hr>
                            <h4 class="cairo">الاحداث والاخبار التابعة للتصنيف</h4>
                            @forelse ($category->posts as $post)
                                <a href="{{ route('posts.show', $post->id) }}" class="badge badge-info">{{ $post->title }}</a>
                            @empty
                                لايوجد
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

