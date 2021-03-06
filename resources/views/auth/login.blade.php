@extends('layouts.backend.auth')

@section('content')

    <div class="content-wrapper">
        <div class="content-header row">
        </div>
        <div class="content-body">
        <section class="flexbox-container">
            <div class="col-12 d-flex align-items-center justify-content-center">
            <div class="col-md-4 col-10 box-shadow-2 p-0">
                <div class="card border-grey border-lighten-3 m-0">
                <div class="card-header border-0">
                    <div class="card-title text-center">
                    <div class="p-1">
                        <img src="../../../app-assets/images/logo/logo-dark.png" alt="branding logo">
                    </div>
                    </div>
                    <h6 class="card-subtitle line-on-side text-muted text-center font-small-3 pt-2">
                    <span>تسجيل الدخول</span>
                    </h6>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        <form class="form-horizontal form-simple" novalidate method="POST" action="{{ route('login') }}">
                            @csrf
                            <fieldset class="form-group position-relative has-icon-left mb-0">
                                <input name='email' type="email" class="form-control form-control-lg input-lg @error('email') is-invalid @enderror" id="email"  value="{{ old('email') }}" placeholder="البريد الالكتروني"
                                required autocomplete="email" autofocus>
                                <div class="form-control-position">
                                    <i class="ficon ft-mail"></i>
                                </div>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </fieldset>
                            <fieldset class="form-group position-relative has-icon-left">
                                <input id="password" name="password" type="password" class="form-control form-control-lg input-lg @error('password') is-invalid @enderror"
                                placeholder="كلمة المرور" required autocomplete="current-password">
                                <div class="form-control-position">
                                    <i class="la la-key"></i>
                                </div>
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </fieldset>
                            <div class="form-group row">
                                <div class="col-md-6 col-12 text-center text-md-left">
                                    <fieldset>
                                        <input type="checkbox" id="remember-me" class="chk-remember" name="remember"  id="remember" {{ old('remember') ? 'checked' : '' }}>
                                        <label for="remember-me"> تذكرني</label>
                                    </fieldset>
                                </div>
                                <div class="col-md-6 col-12 text-center text-md-right">
                                    @if (Route::has('password.request'))
                                        <a class="card-link" href="{{ route('password.request') }}">
                                            إستعادة كلمة المرور
                                        </a>
                                    @endif
                                </div>
                            </div>
                            <button type="submit" class="btn btn-info btn-lg btn-block"><i class="ft-unlock"></i> تسجيل دخول</button>
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
