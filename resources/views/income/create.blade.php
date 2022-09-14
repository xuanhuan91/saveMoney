@extends('layouts.app')

@section('content')
    <div class="container">
        @if(count($errors) >0)
            <div class="alert alert-danger">
                @foreach($errors->all() as $err)
                    <p>{{$err}}</p>
                @endforeach
            </div>
        @endif
        <form method="post" action="{{route('income.store')}}">
            @csrf
            <div class="form-group">
                <label>Thời gian</label>
                <input class="form-control" type="date" name="dateTime" value="{{old('dateTime')}}"/>
            </div>
            {{--            <div class="form-group">--}}
            {{--                <label>Loại khoản thu</label>--}}
            {{--                <input class="form-control" type="text" name="categoryExpenseld" value="{{old('categoryExpenseld')}}"/>--}}
            {{--            </div>--}}

            <div class="form-group ">
                <label for="income_category">Loại khoản thu</label>
                <select name="income_category" id="income_category" class="form-control select2"
                        onchange="chooseSubCategory(this)">
                    @foreach($lscategoryincome as $lscategory)
                        <option value="{{$lscategory->id}}">{{$lscategory->name}}</option>
                    @endforeach

                </select>
            </div>

            <div class="form-group ">
                <label for="income_category">Lựa chọn thành phần loại khoản thu</label>
                <select name="income_category_id" id="subincome_category" class="form-control select2">
                    @foreach($subcategory as $subidcategory)
                        <option value="{{$subidcategory->id}}">{{$subidcategory->name}}</option>
                    @endforeach
                </select>
            </div>

            <script type="text/javascript">
                function chooseSubCategory(answer) {
                    return (answer.value)
                }


            </script>


            <div class="form-group">
                <label>Số tiền</label>
                <input class="form-control" type="text" name="amount" value="{{old('amount')}}"/>
            </div>
            <div class="form-group">
                <label>Ghi Chú</label>
                <textarea class="form-control" name="note"> </textarea>
            </div>
            <div>
                <input style="margin: 10px auto" type="submit" class="btn btn-primary " value="Save">
            </div>

        </form>
    </div>
@endsection
