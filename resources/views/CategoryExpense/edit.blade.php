@extends('layouts.app')

@section('content')
    <div class="container">
        @if(count($errors) > 0)
            <div class="alert alert-danger">
                @foreach($errors->all() as $err)
                    <p>{{$err}}</p>
                @endforeach
            </div>
        @endif

        <form method="post" action="{{route('CategoryExpense.update', $cate->id)}}">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label>Name</label>
                <input  class="form-control" type="text" name="name" value="{{old('name', $cate->name) }}"/>
            </div>
            <div class="form-group py-1">
                <input type="submit" class="btn btn-primary" value="Save"/>
            </div>
        </form>
    </div>
@endsection
