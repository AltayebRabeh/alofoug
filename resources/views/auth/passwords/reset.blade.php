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
                  <span>إعادة تعيين كلمة المرور</span>
                </h6>
              </div>
              <div class="card-content">
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                  <form  method="POST" action="{{ route('password.update') }}" class="form-horizontal" novalidate>
                    @csrf
                    <input type="hidden" name="token" value="{{ $token }}">
                    <fieldset class="form-group position-relative has-icon-left">
                        <input name="email" type="email" id="email" class="form-control form-control-lg input-lg @error('email') is-invalid @enderror"  value="{{ $email ?? old('email') }}" required autocomplete="email"
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

                    <fieldset class="form-group position-relative has-icon-left">
                        <input name="password" type="password" id="password" class="form-control form-control-lg input-lg @error('password') is-invalid @enderror"  value="{{ old('password') }}" autofocus required autocomplete="new-password" autofocus
                        placeholder="كلمة المرور">
                        <div class="form-control-position">
                            <i class="ft-mail"></i>
                        </div>
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </fieldset>

                    <fieldset class="form-group position-relative has-icon-left">
                        <input name="password_confirmation" type="password" id="confirmed_password" class="form-control form-control-lg input-lg @error('confirmed_password') is-invalid @enderror"  value="{{ old('confirmed_password') }}" required autocomplete="new-password" autofocus
                        placeholder="تأكيد كلمة المرور">
                        <div class="form-control-position">
                            <i class="ft-mail"></i>
                        </div>
                        @error('confirmed_password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </fieldset>
                    <button type="submit" class="btn btn-outline-info btn-lg btn-block"><i class="ft-unlock"></i> إعادة تعيين</button>
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
