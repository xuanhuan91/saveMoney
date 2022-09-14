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

        <form method="post" action="{{route('expense.store')}}">
            @csrf
            <div class="form-group">
                <label>Amount</label>
                <input  class="form-control" type="text" name="amount" value="{{old('amount')}}"/>
            </div>
            <div class="form-group">
                <label>Category Expense Id</label>
                <input  class="form-control" type="text" name="categoryExpenseId" value="{{old('categoryExpenseId')}}"/>
            </div>
{{--            <div class="form-group">--}}
{{--                <label>Type Of Expense</label>--}}
{{--                <textarea  class="form-control" name="type">{{old('type')}}</textarea>--}}
{{--            </div>--}}
{{--            <div class="form-group">--}}
{{--                <label>Components Of Expense Type</label>--}}
{{--                <textarea  class="form-control" name="components">{{old('components')}}</textarea>--}}
{{--            </div>--}}
            <div class="form-group">
                <label>Note</label>
                <textarea  class="form-control" name="note">{{old('note')}}</textarea>
            </div>
            <div class="form-group">
                <label>Time</label>
                <input  class="form-control" type="date" name="dateTime" value="{{old('dateTime')}}"/>
            </div>
            <div class="form-group py-1">
                <input type="submit" class="btn btn-primary" value="Save"/>
            </div>
            <div class="form-group py-lg-2">
                <input href="expense.index" type="submit" class="btn btn-danger" value="Cancel"/>
            </div>
        </form>
    </div>
@endsection
