@extends('layouts.app')
@section('content')
    <br>
    <div class="container">
        <h4 class="fw-bold">Thông tin tài khoảnxxx</h4>
        <div class="m-md-3">
            <table class="table bg-white p-5">
                <tbody>
                <tr>
                    <td>Tên tài khoản</td>
                    <th>{{$user->name}}</th>
                </tr>
                <tr>
                    <td>Email</td>
                    <th>{{$user->email}}</th>
                </tr>
                <tr>
                    <td>Mật khẩu</td>
                    <th>
                        <input type="password" value="{{$user->password}}" disabled class="border border-white">
                    </th>
                </tr>
                <tr>
                    <td>Họ và tên</td>
                    <th></th>
                </tr>
                <tr>
                    <td>Ngày sinh</td>
                    <th></th>
                </tr>
                <tr>
                    <td>
                        <!-- Button trigger modal -->
                        <a>
                            <button class="btn btn-primary btn-block" style="width: 60%" data-toggle="modal"
                                    data-target="#exampleModal">Sửa
                            </button>
                        </a>
                    </td>
                    <th></th>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('modalBody')
    <div class="modal-body">
        <h5 class="modal-title fw-bold text-center" id="exampleModalLabel">Sửa thông tin tài khoản</h5>

        <form method="post"  action="{{route('user.update',$user->id)}}">
            @csrf
            @method('put')
            <div>
                <label for="name" class="col-md-12 mb-0 mt-2">{{ __('Tên tài khoản') }}</label>
                <div class="col-md-12">
                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                           value="{{ old('name',$user->name) }}" required autocomplete="name" autofocus>

                    @error('name')
                    <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                    @enderror
                </div>
                <div>
                    <label for="email" class="col-md-12 mb-0 mt-2">{{ __('Email') }}</label>

                    <div class="col-md-12">
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                               name="email" value="{{ old('email',$user->email) }}" required autocomplete="email">

                        @error('email')
                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                            </span>
                        @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <label for="password" class="col-md-12 mb-0 mt-2">{{ __('Mật khẩu') }}</label>
                        <div class="col-md-12">
                            <input id="password" type="password" value="{{old('password',$user->password)}}"
                                   class="form-control @error('password') is-invalid @enderror" name="password" required
                                   autocomplete="new-password">
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div>
                    <label for="" class="col-md-12 mb-0 mt-2">{{ __('Họ và tên') }}</label>

                    <div class="col-md-12">
                        <input disabled id="" type="text" class="form-control" name="" value="{{ old('',$user->name) }}">
                    </div>
                </div>
                <div>
                    <label for="" class="col-md-12 mb-0 mt-2">{{ __('Ngày sinh') }}</label>

                    <div class="col-md-12">
                        <input disabled id="" type="date" class="form-control" name="" value="{{ old('') }}">
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="row justify-content-around">
                        <div class="col-4">
                            <button type="button" class="col btn btn-outline-primary mb-0 mt-2" data-dismiss="modal">
                                Hủy
                            </button>
                        </div>
                        <div class="col-4">
                            <button type="submit" class="col btn btn-primary mb-0 mt-2">Lưu</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
