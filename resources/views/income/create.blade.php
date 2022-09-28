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
            <form method="post" action="{{route('income.store')}}">
                @csrf
                <div class="form-group">
                    <label>Thời gian</label>
                    <input class="form-control" type="date" name="dateTime" value="{{old('dateTime')}}"/>
                </div>


                            <div class="form-group ">
                                <label for="income_category">Loại khoản thu</label>
                                <select name="income_category" id="income_category" class="js-example-basic-single form-control"
                                        onchange="chooseSubCategory(this)">
                                    @foreach($lscategoryincome as $lscategory)
                                        <option value="{{$lscategory->id}}">{{$lscategory->name}}</option>
                                    @endforeach

                                </select>
                            </div>

                            <div class="form-group ">
                                <label for="income_category">Lựa chọn thành phần loại khoản thu</label>
                                <select name="income_category_id" id="subincome_category" class="js-example-basic-single form-control">
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
                    <label for="income_category">Loại khoản thu</label>
                    <select class="js-example-basic-single form-control" id="income_category" name="income_category">
                        @foreach($lscategoryincome as $lscategory)
                            <option value="{{$lscategory->id}}">{{$lscategory->name}}</option>
                        @endforeach

                    </select>
                </div>

                <div class="form-group ">
                    <label for="income_category">Lựa chọn thành phần loại khoản thu</label>
                    <select class="js-example-basic-single form-control" name="income_category_id" id="subincome_category">>
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

@section('content')
{{--    <div class="container">--}}
{{--        @if(count($errors) >0)--}}
{{--            <div class="alert alert-danger">--}}
{{--                @foreach($errors->all() as $err)--}}
{{--                    <p>{{$err}}</p>--}}
{{--                @endforeach--}}
{{--            </div>--}}
{{--        @endif--}}
{{--        <form method="post" action="{{route('income.store')}}">--}}
{{--            @csrf--}}
{{--            <div class="form-group">--}}
{{--                <label>Thời gian</label>--}}
{{--                <input class="form-control" type="date" name="dateTime" value="{{old('dateTime')}}"/>--}}
{{--            </div>--}}


{{--            <div class="form-group ">--}}
{{--                <label for="income_category">Loại khoản thu</label>--}}
{{--                <select name="income_category" id="income_category" class="form-control select2"--}}
{{--                        onchange="chooseSubCategory(this)">--}}
{{--                    @foreach($lscategoryincome as $lscategory)--}}
{{--                        <option value="{{$lscategory->id}}">{{$lscategory->name}}</option>--}}
{{--                    @endforeach--}}

{{--                </select>--}}
{{--            </div>--}}

{{--            <div class="form-group ">--}}
{{--                <label for="income_category">Lựa chọn thành phần loại khoản thu</label>--}}
{{--                <select name="income_category_id" id="subincome_category" class="form-control select2">--}}
{{--                    @foreach($subcategory as $subidcategory)--}}
{{--                        <option value="{{$subidcategory->id}}">{{$subidcategory->name}}</option>--}}
{{--                    @endforeach--}}
{{--                </select>--}}
{{--            </div>--}}

{{--            test 1--}}


{{--                        <div class="form-group ">--}}
{{--                            <label for="income_category">Loại khoản thu</label>--}}
{{--                            <select class="js-example-basic-single form-control" >id="income_category" name="income_category"--}}
{{--                            onchange="chooseSubCategory(this)">--}}
{{--                                @foreach($lscategoryincome as $lscategory)--}}
{{--                                    <option value="{{$lscategory->id}}">{{$lscategory->name}}</option>--}}
{{--                                @endforeach--}}

{{--                            </select>--}}
{{--                        </div>--}}

{{--                        <div class="form-group ">--}}
{{--                            <label for="income_category">Lựa chọn thành phần loại khoản thu</label>--}}
{{--                            <select class="js-example-basic-single form-control" > name="income_category_id" id="subincome_category">--}}
{{--                                @foreach($subcategory as $subidcategory)--}}
{{--                                    <option value="{{$subidcategory->id}}">{{$subidcategory->name}}</option>--}}
{{--                                @endforeach--}}
{{--                            </select>--}}
{{--                        </div>--}}

{{--            <script>--}}
{{--                $(document).ready(function() {--}}
{{--                    $('.js-example-basic-single').select2();--}}
{{--                });--}}
{{--            </script>--}}
{{--                        endtest--}}


{{--            <div class="form-group">--}}
{{--                <label>Số tiền</label>--}}
{{--                <input class="form-control" type="text" name="amount" value="{{old('amount')}}"/>--}}
{{--            </div>--}}
{{--            <div class="form-group">--}}
{{--                <label>Ghi Chú</label>--}}
{{--                <textarea class="form-control" name="note"> </textarea>--}}
{{--            </div>--}}
{{--            <div>--}}
{{--                <input style="margin: 10px auto" type="submit" class="btn btn-primary " value="Save">--}}
{{--            </div>--}}

{{--        </form>--}}
{{--    </div>--}}
@endsection
