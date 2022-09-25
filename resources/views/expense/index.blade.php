@extends('layouts.app')

@section('content')
    <div class="container">
        <br>
        <h2>Quản lý khoản chi</h2>




        <div>
            <form method="post" action="{{route('search')}}">
                @csrf
                <div class="row" >
                    <div class="col">
                        <label for="title">Loại khoản chi</label>
                        <input type="text" class="form-control" name="title" value="{{old('title')}}">
                    </div>

                    <div class="col">
                        <label for="title">Thời gian</label>
                        <input type="date" class="form-control" name="datetime" value="{{old('datetime')}}">
                    </div>
                </div>

                <div >
                    <input  style="margin: 10px " type="submit" class="btn btn-info " value="Tìm kiếm">
                </div>

            </form>
        </div>

        <br><br>

{{--                <button class="btn btn-success btn-block" href='{{route("expense.create")}}' style="width: 70%" data-toggle="modal"--}}
{{--                        data-target="#exampleModal">Thêm mới loại khoản chi--}}
{{--                </button>--}}

            <a class="btn btn-success" href="{{route('expense.create')}}">Thêm mới loại khoản chi</a>
        <br><br>

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
                <th>Số tiền</th>
                <th>Loại khoản chi</th>
                <th>Thành phần loại khoản chi</th>
                <th>Ghi chú</th>
                <th>Sửa</th>
                <th>Xóa</th>
            </tr>
            @foreach($lsexpense as $expense )
                <tr>
                    <td>{{$expense->dateTime}}</td>
                    <td>{{$expense->amount}}</td>
                    <td>
                        @foreach($lscategoryexpense as $categoryExpense)
                            @if($expense->categoryExpense->subCategoryiD!=null)
                                @if($categoryExpense->id == $expense->categoryExpense->subCategoryiD)
                                    {{ $categoryExpense->name}}
                                @endif
                            @else
                                {{$expense->categoryExpense->name}}
                            @endif
                        @endforeach
                    </td>
                    <td>{{$expense->categoryexpense->name}}</td>
                    <td>{{$expense->note}}</td>
                    <td>
                            <form action="">
                                <a class="btn btn-primary" style="width: 70px" href='{{route("expense.edit", $expense->id)}}'>Sửa</a>
                            </form>
{{--                          <button class="btn btn-primary btn-block" href='{{route("expense.edit", $expense->id)}}' style="width: 70%" data-toggle="modal"--}}
{{--                                data-target="#editModal">Sửa--}}
{{--                          </button>--}}
                    </td>
{{--                            <a class="btn btn-primary" href='{{route("expense.edit", $expense->id)}}'>Edit</a>--}}
{{--                            <button class="btn btn-primary " href='{{route("expense.edit", $expense->id)}}' style="width: 40%"--}}
{{--                                    >Edit--}}
{{--                            </button>--}}
{{--                            <button class="btn btn-primary btn-block" href='{{route("expense.edit", $expense->id)}}' style="width: 40%" data-toggle="modal"--}}
{{--                                    data-target="#exampleModal">Sửa--}}
{{--                            </button>--}}
                    <td>
                            <form method="post" action="{{route('expense.destroy', $expense->id)}}"
                                  onsubmit='return confirm("Sure ?")'>
                                @csrf
                                @method('DELETE')
                                <input class="btn btn-danger"  type="submit" value="Xóa" >
                            </form>
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
    <script type="text/javascript">
        function confirmDelete() {
            var value =  confirm("Sure ?");
            return value;
        }
    </script>
@endsection
{{--@section('modalEdit')--}}
{{--    <div class="modal-body">--}}
{{--        <h5 class="modal-title fw-bold text-center" id="exampleModalLabel">Sửa  khoản chi</h5>--}}

{{--        <form method="put"  action="{{ route('expense.update',$expense->id) }}" id="editExpense">--}}
{{--            @csrf--}}
{{--            @method('PUT')--}}
{{--            <input type="number" id="editLimitId" style="display: none">--}}
{{--            <div>--}}
{{--                <div>--}}
{{--                    <label for="amount" class="col-md-12 mb-0 mt-2 " >Số tiền </label>--}}
{{--                    <div class="col-md-12">--}}
{{--                        <input type="number" class="form-control" name="amount" required min="0"--}}
{{--                               value="{{old('amount',$expense->amount) }}" id="amount">--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div>--}}
{{--                    <label for="expense_category" class="col-md-12 mb-0 mt-2">Loại khoản chi</label>--}}
{{--                    <div class="col-md-12">--}}
{{--                    <select name="expense_category" id="expense_category" class="form-control select2"--}}
{{--                            onchange="chooseSubCategory(this)">--}}
{{--                        @foreach($lscategoryexpense as $lscategory)--}}
{{--                            <option value="{{$lscategory->id}}">{{$lscategory->name}}</option>--}}
{{--                        @endforeach--}}

{{--                    </select>--}}
{{--                    </div>--}}

{{--                </div>--}}
{{--                <div class="row">--}}
{{--                    <div class="col-md-12">--}}
{{--                        <label for="expense_category_id" class="col-md-12 mb-0 mt-2">Thành phần loại khoản chi</label>--}}
{{--                        <select name="expense_category_id" id="subexpense_category" class="form-control select2">--}}
{{--                            @foreach($subcategory as $subidcategory)--}}
{{--                                <option value="{{$subidcategory->id}}">{{$subidcategory->name}}</option>--}}
{{--                            @endforeach--}}
{{--                        </select>--}}
{{--                        <div class="col-md-12">--}}
{{--                            <input type="date" class="form-control" id="endDateEdit" name="endDate" required onchange="checkEndDate('startDateEdit','endDateEdit')">--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div>--}}
{{--                    <label for="note" class="col-md-12 mb-0 mt-2">Ghi chú</label>--}}
{{--                    <div class="col-md-12">--}}
{{--                        <input type="text" class="form-control" name="note" value="{{old('note',$expense->note) }}"id="note">--}}
{{--                    </div>--}}
{{--                </div>--}}

{{--                <div class="col-md-12">--}}
{{--                    <div class="row justify-content-around">--}}
{{--                        <div class="col-4">--}}
{{--                            <button type="button" class="col btn btn-outline-primary mb-0 mt-2" data-dismiss="modal">--}}
{{--                                Hủy--}}
{{--                            </button>--}}
{{--                        </div>--}}
{{--                        <div class="col-4">--}}
{{--                            <button type="submit" class="col btn btn-primary mb-0 mt-2">Lưu</button>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </form>--}}
{{--    </div>--}}
{{--@endsection--}}
{{--@section('modalBody')--}}
{{--    <div class="modal-body">--}}
{{--        <h5 class="modal-title fw-bold text-center" id="exampleModalLabel">Thêm mới khoản chi</h5>--}}

{{--        <form method="post"  action="{{route('expense.store')}}">--}}
{{--            @csrf--}}
{{--            @method('POST')--}}
{{--            <div>--}}

{{--                <label for="name" class="col-md-12 mb-0 mt-2 " >Số tiền </label>--}}
{{--                <div class="col-md-12">--}}
{{--                    <input type="number" class="form-control" name="amount"  value="{{old('amount')}} ">--}}
{{--                    <input  class="form-control" type="text" name="amount" value="{{old('amount')}}"/>--}}
{{--                </div>--}}
{{--                <div>--}}
{{--                    <label for="expense_category" class="col-md-12 mb-0 mt-2">Loại khoản chi</label>--}}
{{--                    <div class="col-md-12">--}}
{{--                        <select name="expense_category" id="expense_category" class="form-control select2"--}}
{{--                                onchange="chooseSubCategory(this)">--}}
{{--                            @foreach($lscategoryexpense as $lscategory)--}}
{{--                                <option value="{{$lscategory->id}}">{{$lscategory->name}}</option>--}}
{{--                            @endforeach--}}

{{--                        </select>--}}
{{--                    </div>--}}

{{--                </div>--}}
{{--                <div>--}}
{{--                    <label for="expense_category_id" class="col-md-12 mb-0 mt-2">Thành phần loại khoản chi</label>--}}
{{--                    <div class="col-md-12">--}}
{{--                        <select name="expense_category_id" id="expense_category_id" class="form-control select2"--}}
{{--                                onchange="chooseSubCategory(this)">--}}
{{--                            @foreach($subcategory as $subidcategory)--}}
{{--                                <option value="{{$subidcategory->id}}">{{$subidcategory->name}}</option>--}}
{{--                            @endforeach--}}

{{--                        </select>--}}
{{--                    </div>--}}

{{--                </div>--}}
{{--                <script type="text/javascript">--}}
{{--                    function chooseSubCategory(answer) {--}}
{{--                        return (answer.value)--}}
{{--                    }--}}
{{--                </script>--}}
{{--                <div>--}}
{{--                    <label for="note" class="col-md-12 mb-0 mt-2">Ghi chú</label>--}}
{{--                    <div class="col-md-12">--}}
{{--                        <input type="text" class="form-control" name="note" value="{{old('note') }}"id="note">--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div>--}}
{{--                    <label for="note" class="col-md-12 mb-0 mt-2">Thời gian</label>--}}
{{--                    <div class="col-md-12">--}}
{{--                        <input type="date" class="form-control" name="dateTime" value="{{old('dateTime') }}"id="dateTime">--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div>--}}
{{--                    <label for="" class="col-md-12 mb-0 mt-2"></label>--}}

{{--                    <div class="col-md-12">--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="col-md-12">--}}
{{--                    <div class="row justify-content-around">--}}
{{--                        <div class="col-4">--}}
{{--                            <button type="button" class="col btn btn-outline-primary mb-0 mt-2" data-dismiss="modal">--}}
{{--                                Hủy--}}
{{--                            </button>--}}
{{--                        </div>--}}
{{--                        <div class="col-4">--}}
{{--                            <button type="submit" class="col btn btn-primary mb-0 mt-2">Lưu</button>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </form>--}}
{{--    </div>--}}
{{--@endsection--}}

