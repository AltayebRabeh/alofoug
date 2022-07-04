@extends('layouts.backend.admin')

@section('content')
<div class="content-wrapper">
    <div class="content-header row">
        <div class="content-header-left col-md-6 col-12 mb-2">
            <h3 class="content-header-name mb-0 cairo">المراسلات</h3>
            <div class="row breadcrumbs-top">
                <div class="breadcrumb-wrapper col-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">لوحة التحكم</a>
                        </li>
                        <li class="breadcrumb-item"><a href="{{ route('contacts.index') }}">المراسلات</a>
                        </li>
                        <li class="breadcrumb-item active">عرض
                        </li>
                    </ol>
                </div>
            </div>
        </div>
        <div class="content-header-right text-md-right col-md-6 col-12">
            <div class="btn-group">
                <a href="{{ route('contacts.reply', $contact) }}" class="btn btn-round btn-info" type="button"><i class="la la-mail-reply"></i> رد</a>
            </div>
        </div>
    </div>

    <div class="content-body">

        <div class="row" id="default">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-name cairo">محتوى المراسلة</h4>
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                        <div class="heading-elements">
                            <ul class="list-inline mb-0">
                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-content collapse show">
                        <div class="card-body">
                            <h4 class="card-title cairo">الاسم : {{ $contact->name }}</h4>
                            <h4 class="card-title cairo">البريد الالكتروني : {{ $contact->email }}</h4>
                            <h4 class="card-title cairo">الموضوع : {{ $contact->subject }}</h4>
                            <p class="card-text">الرسالة : <br>{!! $contact->message !!}</p>
                            <p class="card-text d-flex justify-content-between align-items-center">
                                <small class="text-muted">التاريخ {{ $contact->created_at }}</small>
                                <small class="text-muted">عنوان IP المرسل {{ $contact->ip_address }}</small>
                                <small class="text-muted">الجهاز {{ $contact->device }}</small>
                                <small class="text-muted">المنصة {{ $contact->platform }}</small>
                                <small class="text-muted">المتصفح {{ $contact->browser }}</small>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-name cairo">الردود</h4>
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                        <div class="heading-elements">
                            <ul class="list-inline mb-0">
                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-content collapse show">
                        @forelse ($contact->replies as $reply)
                            <div class="card-body">
                                <p class="card-text">الرسالة : <br>{!! $reply->message !!}</p>
                                <p class="card-text d-flex justify-content-between align-items-center">
                                    <small class="text-muted">التاريخ {{ $reply->created_at }}</small>
                                    <small class="text-muted">المرسل {{ $reply->user->name }}</small>
                                </p>
                            </div>
                            @if(!$loop->last)
                                <hr>
                            @endif
                        @empty
                            <p class="text-center">لاتوجد ردود</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

