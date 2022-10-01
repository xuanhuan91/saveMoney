@extends('layouts.app')
@section('scriptSrc')
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
@endsection
@section('content')
    <div class="container" style="margin-top: 40px">
        <h4>Quản lý Khoản Chi </h4>

        {{--         search khoan thu--}}
        <table style="width:100%">
            <tr>
                <td style="width: 300px">Loại khoản Chi</td>
                <td style="padding-left: 200px">Thời gian</td>
            </tr>
        </table>

        <form action="{{route('search1')}}" method="POST" >
            {{csrf_field()}}
            <div class="input-group">
                <input type="text" class="form-control"name="title" placeholder="Type Of Expense">
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
                <th>Loại khoản chi</th>
                <th>Số tiền</th>
                <th>Lựa chọn loại khoản chi</th>
                <th>Ghi chú</th>
                <th>Actor</th>
            </tr>
            @foreach($lsexpense as $expense)
                <tr>
                    <td>{{$expense->dateTime}}</td>
                    <td>
                        @foreach($lscategoryexpense as $categoryExpense)
                            @if($expense->categoryExpense->subCategoryiD!=null)
                                @if($categoryExpense->id == $expense->categoryExpense->subCategoryiD)
                                    {{ $categoryExpense->name}}
                                    <input style="display: none" type="number" value="{{$expense->categoryExpense->subCategoryiD}}" id="subcateId{{$expense->id}}">
                                @endif
                            @else
                                {{$expense->categoryExpense->name}}
                                <input style="display: none" type="number" value="{{$expense->categoryExpense->id}}" id="subcateId{{$expense->id}}">
                            @endif
                        @endforeach
                    </td>
                    <td>
                        {{--                        {{$income->amount}}--}}
                        <?php
                        echo number_format($expense->amount);
                        ?>
                    </td>
                    <td>{{$expense->categoryexpense->name}}</td>
                    <td>{{$expense->note}}</td>
                    <td>
                        <div class="input-group">
                            <a data-target="#editModal" data-toggle="modal" onclick="getExpense({{$expense}})"
                               {{--                               data-toggle="modal"--}}
                               {{--                               data-target="#editModal">--}}
                               class="btn btn-info"   href='#'
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
                            <form method="post" action="{{route('expense.destroy', $expense->id)}}"
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
                    @foreach($lscategoryexpense as $lscategory)
                        <option value="{{$lscategory->id}}">{{$lscategory->name}}</option>
                    @endforeach

                </select>
            </div>

            <div class="form-group ">
                <label for="expense_category">Lựa chọn thành phần loại khoản chi</label>
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

@section('modalEdit')
    <div class="container">
        @if(count($errors) >0)
            <div class="alert alert-danger">
                @foreach($errors->all() as $err)
                    <p>{{$err}}</p>
                @endforeach
            </div>
        @endif
        <form method="post" action="#" id="editForm">
            @csrf
            @method('PUT')
            <input type="number" id="idExpenseEdit">
            <div class="form-group">
                <label>Thời gian</label>
                <input class="form-control" id="dateEdit" type="date" name="dateTime" value="{{old('dateTime')}}"/>
            </div>

            <div class="form-group ">
                <label for="expense_category">Loại khoản chi</label>
                <select name="expense_category" id="expense_categoryEdit" class="form-control select2"
                        onchange="chooseSubCategory(this)">
                    @foreach($lscategoryexpense as $lscategory)
                        <option value="{{$lscategory->id}}">{{$lscategory->name}}</option>
                    @endforeach

                </select>
            </div>
            <div class="form-group ">
                <label for="expense_category">Lựa chọn thành phần loại khoản chi</label>
                <select name="expense_category_id" id="subexpense_categoryEdit" class="form-control select2">
                    @foreach($subcategory as $subidcategory)
                        <option value="{{$subidcategory->id}}">{{$subidcategory->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label>Số tiền</label>
                <input class="form-control" type="text" name="amount" id="amountEdit"
                       value="{{old('amount')}}"
                />
            </div>
            <div class="form-group">
                <label>Ghi Chú</label>
                <textarea class="form-control" name="note" id="noteEdit"> </textarea>
            </div>
            <div>
                <input type="submit" class="btn btn-primary " value="Save">
            </div>

        </form>
    </div>
    <script  type="text/javascript">
        function getID(){
            var editId = document.getElementsByClassName('btn btn-info');
            console.log(editId)
            // return editId;
        }
    </script>
@endsection
@section('script')
    <script>
        function getExpense(expense){
            var expenseId = expense.id;
            var subCateNameId = 'subcateId'+expenseId;
            var subCateId = document.getElementById(subCateNameId).value;

            var date = expense.dateTime;
            var dates = new Date(date);
            var ngay = dates.getDate();
            if(ngay <10){
                ngay = '0'+ngay;
            }
            var month = dates.getMonth()+1;
            if(month <10){
                month = '0'+month;
            }
            var year = dates.getFullYear();
            var dateString = year + '-'+month+'-'+ngay;

            document.getElementById('idExpenseEdit').value = expenseId;
            document.getElementById('dateEdit').value=dateString;
            document.getElementById('amountEdit').value=expense.amount;
            document.getElementById('noteEdit').value = expense.note;
            document.getElementById('expense_categoryEdit').value = subCateId;
            document.getElementById('subexpense_categoryEdit').value = expense.categoryExpenseId;

        }
    </script>
    <script>
        $('#editForm').on('submit',function (e){
            e.preventDefault();
            var date = $('#dateEdit').val();
            var subCateExpense = $('#subexpense_categoryEdit').val();
            var cateExpense = $('#expense_categoryEdit').val();
            var amount = $('#amountEdit').val();
            var note= $('#noteEdit').val();
            var id = $('#idExpenseEdit').val();
            $.ajax({
                type:'PUT',
                url:"/expense/"+ id,
                data:{
                    '_token':'{{csrf_token()}}',
                    'date':date,
                    'subCateExpense':subCateExpense,
                    'cateExpense':cateExpense,
                    'note':note,
                    'amount': amount,
                    'id':id,
                },
                cache:false,
                success:function (result){
                    alert(result);
                    window.location.reload();
                    $('#tableLimit').load('/dashboard/ #tableLimit');
                    $('#editModal').css('display','none');
                    $('.modal-backdrop fade show').css('display','none');
                },
                error:function (){
                    alert('khong chay');
                }
            })
        })
    </script>

@endsection

