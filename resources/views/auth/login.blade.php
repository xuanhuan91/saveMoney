@extends('layouts.authLayout')

@section('content')
<div class="container">

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div>
                <br><br><br><br>
                <div>
                    <img src="img/img_1.png" style="width: 10%;padding-bottom: 40px">
                    <h3 class="fw-bolder">{{ __('Đăng nhập') }}</h3>
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div>
                            <label for="email" class="col-form-label text-md-end">{{ __('Tên tài khoản') }}</label>

                            <div class="col-md-12">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div>
                            <label for="password" class="col-form-label text-md-end">{{ __('Mật khẩu') }}</label>

                            <div class="col-md-12">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-12">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Nhớ tài khoản') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary form-control">
                                    {{ __('Đăng nhập') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}" style="display: none">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-12 text-center text-sm-center">
                                Không có tài khoản?
                                <a href="{{route('register')}}">
                                    Đăng ký tại đây
                                </a>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
