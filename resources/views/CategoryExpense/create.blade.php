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
            <form method="post" action="{{route('CategoryExpense.store')}}">
                @csrf
                <div class="form-group">
                    <label>Tên Loại Khoản Chi</label>
                    <input  class="form-control" type="text" name="name" value="{{old('name')}}"/>
                </div>
                <div class="form-group">
                    <label>Thành Phần loại Khoản Chi</label>
                    <input  class="form-control" type="text" name="subCategoryiD" value="{{old('subCategoryiD')}}"/>
                </div>
                <div class="form-group py-1">
                    <input type="submit" class="btn btn-primary" value="Save"/>
                    <input href="CategoryExpense.index" type="submit" class="btn btn-danger" value="Cancel"/>
                </div>
            </form>
        </div>
@endsection
