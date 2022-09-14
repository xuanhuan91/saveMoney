@extends('layouts.app')


@section('content')
    <div class="container">
        <h4>Edit new Expense </h4>
        <div class="container">
            @if(count($errors) > 0)
                <div class="alert alert-danger">
                    @foreach($errors->all() as $err)
                        <p>{{$err}}</p>
                    @endforeach
                </div>
            @endif
        </div>
        <form action="{{ route('expense.update',$expense) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="amount">Amount</label>
                <input type="text" class="form-control" id="amount" name="amount" value="{{old('amount',$expense->amount) }}" placeholder="Enter amount">
            </div>
{{--            <div class="form-group">--}}
{{--                <label for="type">Type Of Expense</label>--}}
{{--                <input type="text" class="form-control" id="type" name="type" value="{{old('type',$expense->type) }}" placeholder="Enter type">--}}
{{--            </div>--}}
            <div class="form-group">
                <label for="note">Note</label>
                <input type="text" class="form-control" id="note" name="note" value="{{old('note',$expense->note) }}" placeholder="Enter note">
            </div>
            <button type="submit" class="btn btn-primary">Save</button>
        </form>
    </div>

@endsection

