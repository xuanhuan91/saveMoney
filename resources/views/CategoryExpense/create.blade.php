@extends('layouts.app');

@section('content')
    <div class="container">
        @if(count($errors)>0)
            <div class="alert alert-danger">
                @foreach($errors -> all() as $err)
                    <p>{{$err}}</p>
                @endforeach
            </div>
        @endif
        <h2>Expense Category Create</h2>
        <form method="post" action="{{route('CategoryExpense.store')}}">
            @csrf
            <div>
                <label>Name</label>
                <input type="text" size="50" name="name" value="{{old('name')}}">
            </div>
            <br>
            <input type="submit" value="save"/>
        </form>
    </div>

@endsection
