@extends('layouts.authLayout')

@section('content')
<div class="container">

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div>
                <a href="{{route('login')}}" style="margin-left: -50px">
                    <button class="col btn btn-outline-primary border-0" style="--bs-btn-hover-color: #0d6efd;--bs-btn-border-color: #f8fafc;--bs-btn-hover-bg: #f8fafc">Trở về</button>
                </a>
                <div>
                    <h3 class="fw-bolder">{{ __('Đăng ký') }}</h3>
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div>
                            <label for="name" class="col-form-label text-md-end">{{ __('Tên tài khoản') }}</label>

                            <div class="col-md-12">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div>
                            <label for="email" class="col-form-label text-md-end">{{ __('Email') }}</label>

                            <div class="col-md-12">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div>
                        <div class="row">
                            <div class="col-md-6">
                                <label for="password" class="col-form-label text-md-end">{{ __('Mật khẩu') }}</label>
                                <div class="col-md-12">
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="password-confirm" class="col-form-label text-md-end">{{ __('Xác nhận mật khẩu') }}</label>
                                <div class="col-md-12">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                </div>
                            </div>
                        </div>
                        </div>
                        <div>
                            <label for="" class="col-form-label text-md-end">{{ __('Họ và tên') }}</label>

                            <div class="col-md-12">
                                <input id="" type="text" class="form-control" name="" value="{{ old('') }}">
                            </div>
                        </div>
                        <div>
                            <label for="" class="col-form-label text-md-end">{{ __('Ngày sinh') }}</label>

                            <div class="col-md-12">
                                <input id="" type="date" class="form-control" name="" value="{{ old('') }}">
                            </div>
                        </div>
                        <br>

                        <div>
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary col-md-12">
                                    {{ __('Đăng ký') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
