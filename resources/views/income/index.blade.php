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
            <button class="btn btn-primary btn-block " style="width: 10%; float: right" data-toggle="modal"
                    data-target="#exampleModal">Thêm
            </button>
        </a>

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
                <th>Loại khoản thu</th>
                <th>Số tiền</th>
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
                                <a onclick="getID()"
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
{{$lsincome->Links()}}
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

    <div class="container">
{{--    <script  type="text/javascript">--}}
{{--        function getID(){--}}
{{--            var editId = document.getElementsByClassName('btn btn-info');--}}
{{--            return editId;--}}
{{--        }--}}
{{--    </script>--}}

        @if(count($errors) >0)
            <div class="alert alert-danger">
                @foreach($errors->all() as $err)
                    <p>{{$err}}</p>
                @endforeach
            </div>
        @endif
        <form method="post" action="{{route('income.update',$cate->id)}}" id="editForm">
            @csrf
            @method('PUT')
{{--            <div class="form-group">--}}
{{--                <label>Thời gian</label>--}}
{{--                <input class="form-control" type="date" name="dateTime"--}}
{{--                       value="{{old('dateTime', $cate->dateTime)}}"/>--}}
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
{{--            <div class="form-group ">--}}
{{--                <label for="income_category">Lựa chọn thành phần loại khoản thu</label>--}}
{{--                <select name="income_category_id" id="subincome_category" class="form-control select2">--}}
{{--                    @foreach($subcategory as $subidcategory)--}}
{{--                        <option value="{{$subidcategory->id}}">{{$subidcategory->name}}</option>--}}
{{--                    @endforeach--}}
{{--                </select>--}}
{{--            </div>--}}
            <div class="form-group">
                <label>Số tiền</label>
                <input class="form-control" type="text" name="amount"
                       value="{{old('amount', $cate->amount)}}"
                />
            </div>
            <div class="form-group">
                <label>Ghi Chú</label>
                <textarea class="form-control" name="note"> </textarea>
            </div>
            <div>
                <input type="submit" class="btn btn-primary " value="Save">
            </div>

        </form>
    </div>


    <div class="container">

        @if(count($errors) >0)
            <div class="alert alert-danger">
                @foreach($errors->all() as $err)
                    <p>{{$err}}</p>
                @endforeach
            </div>
        @endif
        <form method="put"  action="#" id="editForm">
            @csrf
            @method('PUT')

{{--            <div class="form-group ">--}}
{{--                <label for="income_category">Loại khoản thu</label>--}}
{{--                <select name="income_category" id="income_category" class="form-control select2"--}}
{{--                        onchange="chooseSubCategory(this)">--}}
{{--                    @foreach($lscategoryincome as $lscategory)--}}
{{--                        <option value="{{$lscategory->id}}">{{$lscategory->name}}</option>--}}
{{--                    @endforeach--}}
{{--                </select>--}}
{{--            </div>--}}

            <div>
                <label for="" class="col-md-12 mb-0 mt-2">Loại khoản thu</label>
                <div class="col-md-12">
                    <input type="text" class="form-control" name="income_category" id="income_category">
                </div>
            </div>

            <div class="form-group">
                <label for="name" class="col-md-12 mb-0 mt-2 " >Số tiền</label>
                <div class="col-md-12">
                    <input type="number" class="form-control" name="limit" required min="0" id="limitEdit">
                </div>

            <div>
                <label for="" class="col-md-12 mb-0 mt-2">Ghi chú</label>
                <div class="col-md-12">
                    <input type="text" class="form-control" name="note" id="noteEdit">
                </div>
            </div>

            <div class="col-md-12">
                <div class="row justify-content-around">
                    <div class="col-4">
                        <button type="button" class="col btn btn-outline-primary mb-0 mt-2" data-dismiss="modal">
                            Hủy
                        </button>
                    </div>
                    <div class="col-4">
                        <button type="submit" class="col btn btn-primary mb-0 mt-2">Lưu</button>
                    </div>
                </div>
            </div>
            </div>
        </form>
    </div>

    <script>
        function changeCss(idClicked, idNoClicked, tableClicked, tableNoClicked){
            document.getElementById(idClicked).style.backgroundColor = '#FFFFFF';
            document.getElementById(idClicked).style.margin = '8px';
            document.getElementById(idClicked).style.boxShadow = '0px 4px 8px rgba(0, 0, 0, 0.1)';
            document.getElementById(idClicked).style.borderRadius = '4px';
            document.getElementById(tableClicked).style.display = 'block';

            document.getElementById(idNoClicked).style.borderRadius = '4px';
            document.getElementById(idNoClicked).style.margin = '8px';
            document.getElementById(idNoClicked).style.boxShadow = '';
            document.getElementById(idNoClicked).style.backgroundColor = '';
            document.getElementById(tableNoClicked).style.display = 'none';



            // background-color: #FFFFFF;margin:8px;box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);border-radius: 4px;
        }

        function checkEndDate(startDateId,endDateID){
            var startDate = document.getElementById(startDateId).value;
            var endDate = document.getElementById(endDateID).value;
            if(endDate<=startDate){
                alert('Ngày kết thúc phải sau ngày bắt đầu');
                document.getElementById(endDateID).value='';
            }
        }
        function edit(limit){
            document.getElementById('limitEdit').value=limit.limit;
            document.getElementById('noteEdit').value=limit.note;
            document.getElementById('editLimitId').value=limit.id;
        }
        function edit(limit){
            document.getElementById('limitEdit').value=limit.limit;
            document.getElementById('noteEdit').value=limit.note;
            document.getElementById('editLimitId').value=limit.id;
        }


        function deleteLimit(limit){
            document.getElementById('deleteLimitId').value=limit.id;
        }
    </script>

    <script>
        $('#editForm').on('submit',function (e){
            e.preventDefault();
            var limit = $('#limitEdit').val();
            var startDate = $('#startDateEdit').val();
            var endDate = $('#endDateEdit').val();
            var note = $('#noteEdit').val();
            var id= $('#editLimitId').val();
            $.ajax({
                type:'PUT',
                url:"/expenseLimit/"+id,
                data:{
                    '_token':'{{csrf_token()}}',
                    'startDate':startDate,
                    'endDate':endDate,
                    'limit':limit,
                    'note':note,
                    'id':id,
                },
                cache:false,
                success:function (result){
                    alert(result);
                    $('#tableLimit').load('/dashboard/ #tableLimit');
                    $('#editModal').css('display','none');
                    $('.modal-backdrop fade show').css('display','none');
                },
                error:function (){
                    alert('khong chay');
                }
            })
        })

        $('#deleteForm').on('submit',function (e){
            e.preventDefault();
            var id= $('#deleteLimitId').val();
            $.ajax({
                type:'DELETE',
                url:"/expenseLimit/"+id,
                data:{
                    '_token':'{{csrf_token()}}',
                    'id':id,
                },
                cache:false,
                success:function (result){
                    alert(result);
                    $('#tableLimit').load('/dashboard/ #tableLimit');
                    $('#deleteModal').css('display','none');
                    $('.modal-backdrop fade show').css('display','none');
                },
                error:function (){
                    alert('khong chay');
                }
            })
        })

        $('#startDate').on('change', function(e) {
            e.preventDefault();
            var startDate = $('#startDate').val();
            $.ajax({
                type:'GET',
                url:"/checkStartDate/",
                data: {
                    '_token':'{{csrf_token()}}',
                    'startDate':startDate,
                },
                cache:false,
                success:function (result){
                    alert(result);
                },
            })
        });
        $('#startDateEdit').on('change', function(e) {
            e.preventDefault();
            var startDate = $('#startDateEdit').val();
            $.ajax({
                type:'GET',
                url:"/checkStartDate/",
                data: {
                    '_token':'{{csrf_token()}}',
                    'startDate':startDate,
                },
                cache:false,
                success:function (result){
                    if(result!=''){
                        alert(result);
                        $('#editForm').submit();
                    }
                },
            })
        });
    </script>
@endsection

