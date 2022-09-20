@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="container">
            @if(count($errors) > 0)
                <div class="alert alert-danger">
                    @foreach($errors->all() as $err)
                        <p>{{$err}}</p>
                    @endforeach
                </div>
            @endif
        <form method="post" action="{{route('CategoryIncome.store')}}">
            @csrf
            <div class="form-group">
                <label>Loại Khoản Thu</label>
                <input  class="form-control" type="text" name="name" value=""/>
            </div>
            <div class="form-group">
                <label>Thành Phần loại Khoản Thu</label>
                <input  class="form-control" type="text" name="subname" value=""/>
            </div>
{{--            <div class="form-group">--}}
{{--                <label>Khoản Thu Con</label>--}}
{{--                <textarea class="form-control" name="note">{{old('note')}}</textarea>--}}
{{--            </div>--}}
            <div class="form-group py-1">
                <input type="submit" class="btn btn-primary" value="Save"/>
            </div>
        </form>
    </div>
@endsection
