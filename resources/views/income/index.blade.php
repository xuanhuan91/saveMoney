@extends('layouts.app')

@section('content')
    <div class="container" style="margin-top: 40px">
        <h4>Quản lý Khoản Thu </h4>

        {{--         search khoan thu--}}
        <table style="width:100%">
            <tr>
                <td style="width: 300px">Loại khoản thu</td>
                <td style="padding-left: 200px">Thời gian</td>
            </tr>
        </table>

        <form action="{{route('search')}}" method="POST" >
            {{csrf_field()}}
            <div class="input-group">
                <input type="text" class="form-control"name="title" placeholder="Type Of Income">
                <span style="margin: 0 5px"></span>
                <input type="date" class="form-control"  name="datetime" placeholder="Time">
            </div>
            <div>
                <span class="input-group-btn"
                      style="     display: flex;
                                  justify-content: center;
                                  align-items: center;
                                  margin: 10px 0";>

                    <button type="submit" class="btn btn-info" style=" --bs-btn-color: #fff;
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
                                                --bs-btn-disabled-border-color: #0a58ca;">
                        <a  class="fas fa-search fa-sm" ></a> Tìm kiếm
                    </button>
                </span>
            </div>
        </form>
        {{--        End Search--}}

        <a>
            <button class="btn btn-primary btn-block " style="width: 10%; float: right"
                    data-toggle="modal"
                    data-target="#exampleModal">Thêm
            </button>
        </a>

        {{--        <p>--}}
        {{--            <a--}}
        {{--                class="btn btn-primary btn-block "--}}
        {{--                href="{{route('income.create')}}"--}}
        {{--               style="width: 10%; float: right"--}}
        {{--            >Thêm</a>--}}
        {{--            --}}{{--            <a class="btn btn-success" href="">Add New Income</a>--}}
        {{--        </p>--}}

        <div class="flash-message">

            @foreach(['danger', 'success', 'warning', 'info'] as $type)
                @if(\Illuminate\Support\Facades\Session::has($type))
                    <p class="alert alert-{{$type}}">
                        {{\Illuminate\Support\Facades\Session::get($type)}}
                    </p>
                @endif
            @endforeach
        </div>

        <table class="table">
            <tr>
                <th>Thời gian</th>
                <th>Loại khoản thu</th>
                <th>Số tiền</th>
                <th>Lựa chọn loại khoản thu</th>
                <th>Ghi chú</th>
                <th>Actor</th>
            </tr>
            @foreach($lsincome as $income)
                <tr>
                    <td>{{$income->dateTime}}</td>
                    <td>
                        @foreach($lscategoryincome as $categoryIncome)
                            @if($income->categoryIncome->subCategoryiD!=null)
                                @if($categoryIncome->id == $income->categoryIncome->subCategoryiD)
                                    {{ $categoryIncome->name}}
                                @endif
                            @else
                                {{$income->categoryIncome->name}}
                            @endif
                        @endforeach
                    </td>
                    <td>
                        {{--                        {{$income->amount}}--}}
                        <?php
                        echo number_format($income->amount);
                        ?>
                    </td>
                    <td>{{$income->categoryincome->name}}</td>
                    <td>{{$income->note}}</td>
                    <td>
                        <div class="input-group">
                            <a
                                {{--                               data-toggle="modal"--}}
                                {{--                               data-target="#editModal">--}}
                                class="btn btn-info"   href='{{route("income.edit", $income->id)}}'
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
                            >Edit</a>
                            <span style="margin-left: 2px"></span>
                            <form method="post" action="{{route('income.destroy', $income->id)}}"
                                  onsubmit='return confirm("You want to delete ?? ")'>
                                @csrf
                                @method('DELETE')
                                <input class="btn btn-danger" type="submit" value="Delete" >
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
        </table>
        {{--        {{$lsincome->Links()}}--}}
    </div>

    <script type="text/javascript">
        function confirmDelete() {
            var value = confirm("You want to delete ? ");
            return value;
        }
    </script>
@endsection

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
                    class="btn btn-info"   href='{{route("income.index")}}'
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

{{--@section('modalEdit')--}}
{{--    <div class="container">--}}
{{--        @if(count($errors) >0)--}}
{{--            <div class="alert alert-danger">--}}
{{--                @foreach($errors->all() as $err)--}}
{{--                    <p>{{$err}}</p>--}}
{{--                @endforeach--}}
{{--            </div>--}}
{{--        @endif--}}
{{--        <form method="post" action="{{route('income.update',$cate->id)}}">--}}
{{--            @csrf--}}
{{--            @method('PUT')--}}
{{--            <div class="form-group">--}}
{{--                <label>Thời gian</label>--}}
{{--                <input class="form-control" type="date" name="dateTime" value="{{old('dateTime', $cate->dateTime)}}"/>--}}
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
{{--            <div class="form-group">--}}
{{--                <label>Số tiền</label>--}}
{{--                <input class="form-control" type="text" name="amount"--}}
{{--                       value="{{old('amount', $cate->amount)}}"--}}
{{--                />--}}
{{--            </div>--}}
{{--            <div class="form-group">--}}
{{--                <label>Ghi Chú</label>--}}
{{--                <textarea class="form-control" name="note"> </textarea>--}}
{{--            </div>--}}
{{--            <div>--}}
{{--                <input type="submit" class="btn btn-primary " value="Save">--}}
{{--            </div>--}}

{{--        </form>--}}
{{--    </div>--}}
{{--    <script  type="text/javascript">--}}
{{--        function getID(){--}}
{{--            var editId = document.getElementsByClassName('btn btn-info');--}}
{{--            console.log(editId)--}}
{{--            // return editId;--}}
{{--        }--}}
{{--    </script>--}}
{{--@endsection--}}
