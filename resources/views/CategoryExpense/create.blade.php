@extends('layouts.app')

@section('content')
    <div class="container">
        <form method="post" action="{{route('categoryExpense.store')}}">
            @csrf
            <div class="form-group">
                <label>Name</label>
                <input  class="form-control" type="text" name="name" value=""/>
            </div>
            <div class="form-group py-1">
                <input type="submit" class="btn btn-primary" value="Save"/>
            </div>
        </form>
    </div>
@endsection
