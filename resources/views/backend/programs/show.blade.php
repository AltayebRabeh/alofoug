@extends('layouts.backend.admin')

@section('content')
<div class="content-wrapper">
    <div class="content-header row">
        <div class="content-header-left col-md-6 col-12 mb-2">
            <h3 class="content-header-name mb-0 cairo">البرامج</h3>
            <div class="row breadcrumbs-top">
                <div class="breadcrumb-wrapper col-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">لوحة التحكم</a>
                        </li>
                        <li class="breadcrumb-item"><a href="{{ route('programs.index') }}">البرامج</a>
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
                        <h1 class="card-name cairo">تفاصيل البرنامج بالعربي</h1>
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                        <div class="heading-elements">
                            <ul class="list-inline mb-0">
                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-content collapse show">
                        <div class="card-body">
                            <h1 class="card-name cairo">{{ $program->name }}</h1>
                            <p class="card-text">{!! $program->description !!}</p>
                            <div class="card-text d-flex justify-content-between align-items-center">
                                <small class="text-muted">{{ $program->created_at }}</small>
                                <div class="degree">
                                    الدرجة العلمية:
                                    {{ $program->degree->name }}
                                </div>

                                @if ($program->e_learning_url)
                                    <div class="degree">
                                        رابط التعليم الالكتروني:
                                        <a href="{{ $program->e_learning_url }}">{{ $program->e_learning_url }}</a>
                                    </div>
                                @endif

                                @if ($program->classrooms->count() > 0)
                                    <div class="classrooms">
                                        الفصول
                                        @foreach ($program->classrooms as $classroom)
                                            <span class="badge badge-info">{{ $classroom->name }}</span>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <h4 class="card-name cairo">تفاصيل البرنامج بالنجليزي</h4>
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                        <div class="heading-elements">
                            <ul class="list-inline mb-0">
                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-content collapse show">
                        <div class="card-body">
                            <h4 class="card-name cairo">{{ $program->getTranslation('name', 'en') }}</h4>
                            <p class="card-text">{!! $program->getTranslation('description', 'en') !!}</p>
                            <div class="card-text d-flex justify-content-between align-items-center">
                                <small class="text-muted">{{ $program->created_at }}</small>
                                <div class="degree">
                                    الدرجة العلمية:
                                    {{ $program->degree->getTranslation('name', 'en') }}
                                </div>

                                @if ($program->e_learning_url)
                                    <div class="degree">
                                        رابط التعليم الالكتروني:
                                        <a href="{{ $program->e_learning_url }}">{{ $program->e_learning_url }}</a>
                                    </div>
                                @endif

                                @if ($program->classrooms->count() > 0)
                                    <div class="classrooms">
                                        الفصول
                                        @foreach ($program->classrooms as $classroom)
                                            <span class="badge badge-info">{{ $classroom->getTranslation('name', 'en') }}</span>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

