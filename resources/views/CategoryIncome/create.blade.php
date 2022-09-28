@extends('layouts.app')
@section('modalBody')
    <div class="container">
        @if(count($errors) >0)
            <div class="alert alert-danger">
                @foreach($errors->all() as $err)
                    <p>{{$err}}</p>
                @endforeach
            </div>
        @endif
        <form method="post" action="{{route('CategoryIncome.store')}}">
            @csrf
            <div class="form-group">--}}
                <label>Tên Loại Khoản Thu</label>
                <input  class="form-control" type="text" name="name" value="{{old('name')}}"/>
            </div>
            <div class="form-group">
                <label>Thành Phần loại Khoản Thu</label>
                <input  class="form-control" type="text" name="subCategoryiD" value="{{old('subCategoryiD')}}"/>
            </div>
            <script>
                $(document).ready(function() {
                    $('.js-example-basic-single').select2();
                });
            </script>
            test 1
            <div class="form-group">--}}
                <label>Tên Loại Khoản Thu</label>
                <input  class="form-control" type="text" name="name" value="{{old('name')}}"/>
            </div>
            <div class="form-group">
                <label>Thành Phần loại Khoản Thu</label>
                <input  class="form-control" type="text" name="subCategoryiD" value="{{old('subCategoryiD')}}"/>
            </div>
            <script>
                $(document).ready(function() {
                    $('.js-example-basic-single').select2();
                });
            </script>
            endtest
            <div>
                <input style="margin: 10px auto" type="submit" class="btn-warning" value="Cancel">
                <input href="CategoryIncome.index" style="margin: 10px auto" type="submit" class="btn btn-primary " value="Save">
            </div>

        </form>
    </div>
@endsection
@section('content')
@endsection
{{--@extends('layouts.app')--}}

{{--@section('content')--}}
{{--    <div class="container">--}}
{{--        <div class="container">--}}
{{--            @if(count($errors) > 0)--}}
{{--                <div class="alert alert-danger">--}}
{{--                    @foreach($errors->all() as $err)--}}
{{--                        <p>{{$err}}</p>--}}
{{--                    @endforeach--}}
{{--                </div>--}}
{{--            @endif--}}
{{--        <form method="post" action="{{route('CategoryIncome.store')}}">--}}
{{--            @csrf--}}
{{--            <div class="form-group">--}}
{{--                <label>Tên Loại Khoản Thu</label>--}}
{{--                <input  class="form-control" type="text" name="name" value="{{old('name')}}"/>--}}
{{--            </div>--}}
{{--            <div class="form-group">--}}
{{--                <label>Thành Phần loại Khoản Thu</label>--}}
{{--                <input  class="form-control" type="text" name="subCategoryiD" value="{{old('subCategoryiD')}}"/>--}}
{{--            </div>--}}
{{--            <div class="form-group py-1">--}}
{{--                <input type="submit" class="btn btn-primary" value="Save"/>--}}
{{--                <input href="CategoryIncome.index" type="submit" class="btn btn-danger" value="Cancel"/>--}}
{{--            </div>--}}
{{--        </form>--}}
{{--    </div>--}}
{{--@endsection--}}
