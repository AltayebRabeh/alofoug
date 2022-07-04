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
                        <li class="breadcrumb-item"><a href="{{ route('results.index') }}">النتائج</a>
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
                        <h4 class="card-title cairo">تفاصيل النتيجة</h4>
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                        <div class="heading-elements">
                            <ul class="list-inline mb-0">
                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-content collapse show">
                        <div class="card-body">
                            <p class="card-text">
                                الوصف بالعربي:
                                <br>
                                {!! $result->description !!}
                            </p>
                            <p class="card-text">
                                الوصف بالانجليزي:
                                <br>
                                {!! $result->getTranslation('description', 'en') !!}
                            </p>
                            <div class="table-responsive">
                                <table class="table mb-0">
                                    @forelse ($excel as $result)
                                        <tr>
                                        @if($loop->first)
                                            @foreach ($result as $key => $value)

                                                    <th>{{ $key }}</th>
                                            @endforeach
                                            </tr>
                                        @endif

                                        @foreach ($result as $key => $value)
                                            @if(gettype($value) == 'double')
                                                <td>{{ number_format($value, 2) }}</td>
                                            @else
                                                <td>{{ $value }}</td>
                                            @endif
                                        @endforeach

                                        </tr>

                                    @empty
                                        <tr>
                                            <td colspan="6" class="text-center">لاتوجد سجلات لعرضها</td>
                                        </tr>
                                    @endforelse
                                </table>
                              </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

