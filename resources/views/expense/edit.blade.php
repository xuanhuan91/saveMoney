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
        <form method="post" action="{{route('expense.store')}}">
            @csrf
            <div class="form-group">
                <label>Thời gian</label>
                <input class="form-control" type="date" name="dateTime" value="{{old('dateTime')}}"/>
            </div>


            <div class="form-group ">
                <label for="expense_category">Loại khoản chi</label>
                <select name="expense_category" id="expense_category" class="form-control select2"
                        onchange="chooseSubCategory(this)">
                    @foreach($lscategoryincome as $lscategory)
                        <option value="{{$lscategory->id}}">{{$lscategory->name}}</option>
                    @endforeach

                </select>
            </div>

            <div class="form-group ">
                <label for="expense_category">Lựa chọn thành phần loại khoản thu</label>
                <select name="expense_category_id" id="subexpense_category" class="form-control select2">
                    @foreach($subcategory as $subidcategory)
                        <option value="{{$subidcategory->id}}">{{$subidcategory->name}}</option>
                    @endforeach
                </select>
            </div>


            <div class="form-group">
                <label>Số tiền</label>
                <input class="form-control" type="text" name="amount" value="{{old('amount')}}"/>
            </div>
            <div class="form-group">
                <label>Ghi Chú</label>
                <textarea class="form-control" name="note"> </textarea>
            </div>
            <div>
                <input style="margin-right: 15px" type="submit" class="btn btn-primary " value="Save">
                <a
                    class="btn btn-info"   href='{{route("expense.index")}}'
                    style=" --bs-btn-color: #fff;
                                        --bs-btn-bg: #0d6efd;
                                        --bs-btn-border-color: #0a58ca;
                                        --bs-btn-hover-color: #fff;
                                        --bs-btn-hover-bg: #0a58ca;
                                        --bs-btn-hover-border-color: #0a58ca;
                                        --bs-btn-focus-shadow-rgb: 11, 172, 204;
                                        --bs-btn-active-color: #fff;
                                        --bs-btn-active-bg: #0a58ca;
                                        --bs-btn-active-border-color: #0a58ca;
                                        --bs-btn-active-shadow: inset 0 3px 5px rgba(0, 0, 0, 0.125);
                                        --bs-btn-disabled-color: #fff;
                                        --bs-btn-disabled-bg: #0a58ca;
                                        --bs-btn-disabled-border-color: #0a58ca;"
                >Hủy</a>
            </div>

        </form>
    </div>
@endsection

{{--@section('content')--}}
{{--    <div class="container">--}}
{{--        <h4>Sửa loại khoản chi </h4>--}}
{{--        <div class="container">--}}
{{--            @if(count($errors) > 0)--}}
{{--                <div class="alert alert-danger">--}}
{{--                    @foreach($errors->all() as $err)--}}
{{--                        <p>{{$err}}</p>--}}
{{--                    @endforeach--}}
{{--                </div>--}}
{{--            @endif--}}
{{--        </div>--}}
{{--        <form action="{{ route('expense.update',$cate->id) }}" method="POST">--}}
{{--            @csrf--}}
{{--            @method('PUT')--}}
{{--            <div class="form-group">--}}
{{--                <label for="amount">Số tiền</label>--}}
{{--                <input type="text" class="form-control" id="amount" name="amount" value="{{old('amount',$cate->amount) }}" placeholder="Enter amount">--}}
{{--            </div>--}}
{{--            <div class="form-group ">--}}
{{--                <label for="expense_category">Loại khoản chi</label>--}}
{{--                <select name="expense_category" id="expense_category" class="form-control select2"--}}
{{--                        onchange="chooseSubCategory(this)">--}}
{{--                    @foreach($lscategoryexpense as $lscategory)--}}
{{--                        <option value="{{$lscategory->id}}">{{$lscategory->name}}</option>--}}
{{--                    @endforeach--}}

{{--                </select>--}}
{{--            </div>--}}
{{--            <div class="form-group ">--}}
{{--                <label for="expense_category_id">Thành phần loại khoản chi</label>--}}
{{--                <select name="expense_category_id" id="subexpense_category" class="form-control select2">--}}
{{--                    @foreach($subcategory as $subidcategory)--}}
{{--                        <option value="{{$subidcategory->id}}">{{$subidcategory->name}}</option>--}}
{{--                    @endforeach--}}
{{--                </select>--}}
{{--            </div>--}}
{{--            <div class="form-group">--}}
{{--                <label for="type">Type Of Expense</label>--}}
{{--                <input type="text" class="form-control" id="type" name="type" value="{{old('type',$expense->type) }}" placeholder="Enter type">--}}
{{--            </div>--}}
{{--            <div class="form-group">--}}
{{--                <label for="note">Ghi chú</label>--}}
{{--                <input type="text" class="form-control" id="note" name="note" value="{{old('note',$cate->note) }}" placeholder="Enter note">--}}
{{--            </div>--}}
{{--            <button type="submit" class="btn btn-primary">Save</button>--}}
{{--        </form>--}}
{{--    </div>--}}

{{--@endsection--}}

