@extends('layouts.backend.auth')

@section('content')

<div class="content-wrapper">
    <div class="content-header row">
    </div>
    <div class="content-body">
      <section class="flexbox-container">
        <div class="col-12 d-flex align-items-center justify-content-center">
          <div class="col-md-4 col-10 box-shadow-2 p-0">
            <div class="card border-grey border-lighten-3 px-2 py-2 m-0">
              <div class="card-header border-0 pb-0">
                <div class="card-title text-center">
                  <img src="../../../app-assets/images/logo/logo-dark.png" alt="branding logo">
                </div>
                <h6 class="card-subtitle line-on-side text-muted text-center font-small-3 pt-2">
                  <span>سيتم إرسال رابط إليك لإعادة تعين كلمة المرور</span>
                </h6>
              </div>
              <div class="card-content">
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                  <form  method="POST" action="{{ route('password.email') }}" class="form-horizontal" novalidate>
                    @csrf
                    <fieldset class="form-group position-relative has-icon-left">
                        <input name="email" type="email" id="email" class="form-control form-control-lg input-lg @error('email') is-invalid @enderror"  value="{{ old('email') }}" required autocomplete="email" autofocus
                        placeholder="عنوان بريدك الالكتروني">
                        <div class="form-control-position">
                            <i class="ft-mail"></i>
                        </div>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </fieldset>
                    <button type="submit" class="btn btn-outline-info btn-lg btn-block"><i class="ft-unlock"></i> إستعادة كلمة المرور</button>
                  </form>
                </div>
              </div>
              <div class="card-footer border-0">
                <p class="float-sm-left text-center">إذهب إلى <a href="{{ route('login') }}" class="card-link">تسجيل الدخول</a></p>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>
  </div>
@endsection
