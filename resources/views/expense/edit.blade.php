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
        <form action="{{ route('expense.update',$cate->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="amount">Amount</label>
                <input type="text" class="form-control" id="amount" name="amount" value="{{old('amount',$cate->amount) }}" placeholder="Enter amount">
            </div>
            <div class="form-group ">
                <label for="expense_category">Type of Expense</label>
                <select name="expense_category" id="expense_category" class="form-control select2"
                        onchange="chooseSubCategory(this)">
                    @foreach($lscategoryexpense as $lscategory)
                        <option value="{{$lscategory->id}}">{{$lscategory->name}}</option>
                    @endforeach

                </select>
            </div>
            <div class="form-group ">
                <label for="expense_category_id">Components Of Expense Type</label>
                <select name="expense_category_id" id="subexpense_category" class="form-control select2">
                    @foreach($subcategory as $subidcategory)
                        <option value="{{$subidcategory->id}}">{{$subidcategory->name}}</option>
                    @endforeach
                </select>
            </div>
{{--            <div class="form-group">--}}
{{--                <label for="type">Type Of Expense</label>--}}
{{--                <input type="text" class="form-control" id="type" name="type" value="{{old('type',$expense->type) }}" placeholder="Enter type">--}}
{{--            </div>--}}
            <div class="form-group">
                <label for="note">Note</label>
                <input type="text" class="form-control" id="note" name="note" value="{{old('note',$cate->note) }}" placeholder="Enter note">
            </div>
            <button type="submit" class="btn btn-primary">Save</button>
        </form>
    </div>

@endsection

