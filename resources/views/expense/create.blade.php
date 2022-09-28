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
                <label for="expense_category">Loại khoản Chi</label>
                <select name="expense_category" id="expense_category" class="js-example-basic-single form-control"
                        onchange="chooseSubCategory(this)">
                    @foreach($lscategoryexpense as $lscategory)
                        <option value="{{$lscategory->id}}">{{$lscategory->name}}</option>
                    @endforeach

                </select>
            </div>

            <div class="form-group ">
                <label for="expense_category">Lựa chọn thành phần loại khoản chi</label>
                <select name="expense_category_id" id="subexpense_category" class="js-example-basic-single form-control">
                    @foreach($subcategory as $subidcategory)
                        <option value="{{$subidcategory->id}}">{{$subidcategory->name}}</option>
                    @endforeach
                </select>
            </div>

            <script>
                $(document).ready(function() {
                    $('.js-example-basic-single').select2();
                });
            </script>


            test 1


            <div class="form-group ">
                <label for="expense_category">Loại khoản chi</label>
                <select class="js-example-basic-single form-control" id="expense_category" name="expense_category">
                    @foreach($lscategoryexpense as $lscategory)
                        <option value="{{$lscategory->id}}">{{$lscategory->name}}</option>
                    @endforeach

                </select>
            </div>

            <div class="form-group ">
                <label for="expense_category">Lựa chọn thành phần loại khoản chi</label>
                <select class="js-example-basic-single form-control" name="expense_category_id" id="subexpense_category">>
                    @foreach($subcategory as $subidcategory)
                        <option value="{{$subidcategory->id}}">{{$subidcategory->name}}</option>
                    @endforeach
                </select>
            </div>

            <script>
                $(document).ready(function() {
                    $('.js-example-basic-single').select2();
                });
            </script>
            endtest


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

@endsection
{{--@section('content')--}}
{{--    <div class="container">--}}
{{--        @if(count($errors) > 0)--}}
{{--            <div class="alert alert-danger">--}}
{{--                @foreach($errors->all() as $err)--}}
{{--                    <p>{{$err}}</p>--}}
{{--                @endforeach--}}
{{--            </div>--}}
{{--        @endif--}}

{{--        <form method="post" action="{{route('expense.store')}}">--}}
{{--            @csrf--}}
{{--            <div class="form-group">--}}
{{--                <label>Số Tiền</label>--}}
{{--                <input  class="form-control" type="text" name="amount" value="{{old('amount')}}"/>--}}
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

{{--            <script type="text/javascript">--}}
{{--                function chooseSubCategory(answer) {--}}
{{--                    return (answer.value)--}}
{{--                }--}}
{{--            </script>--}}
{{--            <div>--}}
{{--                <label>Ghi chú</label>--}}
{{--                <textarea  class="form-control" name="note">{{old('note')}}</textarea>--}}
{{--            </div>--}}
{{--            <div class="form-group">--}}
{{--                <label>Thời gian</label>--}}
{{--                <input  class="form-control" type="date" name="dateTime" value="{{old('dateTime')}}"/>--}}
{{--            </div>--}}
{{--            <div class="form-group py-1">--}}
{{--                <input type="submit" class="btn btn-primary" value="Save"/>--}}
{{--            </div>--}}
{{--            <div class="form-group py-lg-2" >--}}
{{--                <input href="{{route('expense.index')}}"  type="submit" class="btn btn-danger" value="Cancel"/>--}}
{{--            </div>--}}
{{--        </form>--}}
{{--    </div>--}}
{{--@endsection--}}
