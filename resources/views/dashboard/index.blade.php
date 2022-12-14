@extends('layouts.app')
@section('scriptSrc')
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
@endsection

@section('content')
    <?php use Carbon\Carbon?>
    <div class="container">
        <div class="container" style="padding-top: 10px">
            <h4>Bảng tin</h4>
        </div>
        <div class="row" style="padding-left: 30px">
            <div class="col-7">
                <div class="row bg-white" style="height: 120px">
                    <div class="row">
                        <div class="col" style="padding-top: 8px">
                            <h5>Hạn mức khoản chi</h5>
                        </div>
                        <div class="col">
                            <ul class="navbar navbar-expand-lg navbar-light" style="float: right;margin:0;">
                                <li class="nav-item active" style="list-style: none" data-toggle="modal"
                                    data-target="#exampleModal">
                                    <img src="{{ URL::to('/') }}/img/img_5.png" style="width: 22px; margin-right:20px"/>
                                </li>
                                <li class="nav-item active " style="list-style: none" data-toggle="modal"
                                    data-target="#editModal">
                                    <img src="{{ URL::to('/') }}/img/img_6.png" style="width: 22px; margin-right:20px"/>
                                </li>
                                <li class="nav-item active text-danger" style="list-style: none">
                                    <img src="{{ URL::to('/') }}/img/img_7.png" style="width: 22px"/>
                                </li>

                            </ul>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-2" data-toggle="modal"
                             data-target="#modalIndex">
                            <img src="{{ URL::to('/') }}/img/img_4.png" style="width: 64px"/>
                        </div>
                        <div class="col-10" data-toggle="modal"
                             data-target="#modalIndex">
                            <div class="row" style="text-align: left; margin-bottom: 0">
                                <p style="margin-bottom: 0">Hạn mức</p>
                            </div>
                            <div class="row">
                                <h4 class="fw-bolder"><?php
//                                    if($currentLimit->count() != 0){
                                    if($currentLimit!= 0){

                                        echo number_format($currentLimit);
                                    }
                                    ?> VND</h4>
                                <span class="text-danger fw-bold">{{$warning}}</span>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="row bg-white" style="height: 475px; margin-top: 20px">
                    <div class="row" style="padding-top: 20px;height: 30px">
                        <h6>Tổng số khoản thu/chi trong tháng {{Carbon::now()->month}}</h6>
                    </div>
                    <div class="row"
                         style="border-radius: 6px;background-color: #F5F6F8;height: 102px;width: 95%; margin: auto">
                        <div class="col" style="margin:5px;border-radius: 4px; height: 90%" id="iconIncome" onclick="changeCss('iconIncome','iconExpense','tableIncome','tableExpense')">
                            <div class="row">
                                <div class="col-3">
                                    <img src="{{ URL::to('/') }}/img/img_9.png" style="width: 32px;padding-top: 15px"/>
                                </div>
                                <div class="col-9" style="padding-top: 15px">
                                    <p style="margin-bottom: 0">Khoản thu</p>
                                    <h4 class="fw-bolder"><?php
                                        echo number_format($sumIncome);
                                        ?> VND</h4>
                                </div>
                            </div>
                        </div>
                        <div class="col" style="height: 90%;background-color: #FFFFFF;margin:5px;box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);border-radius: 4px;" id="iconExpense" onclick="changeCss('iconExpense','iconIncome','tableExpense','tableIncome')">
                            <div class="row">
                                <div class="col-3">
                                    <img src="{{ URL::to('/') }}/img/img_8.png" style="width: 32px;padding-top: 15px"/>
                                </div>
                                <div class="col-9" style="padding-top: 15px">
                                    <p style="margin-bottom: 0">Khoản chi</p>
                                    <h4 class="fw-bolder">
                                        <?php
                                        echo number_format($sumExpense);
                                        ?> VND
                                    </h4>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="row" style="" >
                        <div id="tableIncome" style="display: none">
                            <table class="table" id="tbIc">
                                <thead class="text-center">
                                <tr class="text-secondary">
                                    <td class="col-4" class="align-middle">Thời gian</td>
                                    <td class="col-4" class="align-middle">Loại khoản thu</td>
                                    <td class="col-4" class="align-middle">Số tiền</td>
                                </tr>
                                </thead>
                                <tbody >
                                @foreach($incomes as $income)
                                    <tr>
                                        <td>
                                            <?php
                                            $y = Carbon::create($income->dateTime);
                                            echo($y->format('d-m-Y'));
                                            ?>
                                        </td>
                                        <td>
                                            {{$income->categoryIncome->name}}
                                        </td>
                                        <td class="text-end">
                                            <?php
                                            echo number_format($income->amount);
                                            ?> VND
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <nav class="d-flex justify-items-center justify-content-between">
                                <div class="d-none flex-sm-fill d-sm-flex align-items-sm-center justify-content-sm-between">
                                    <div>
                                        <p class="small text-muted">
                                            Xem
                                            <span class="fw-semibold">{{$incomes->firstItem()}}</span>
                                            đến
                                            <span class="fw-semibold">{{$incomes->lastItem()}}</span>
                                            của
                                            <span class="fw-semibold">{{$incomes->total()}}</span>
                                            bản ghi
                                        </p>
                                    </div>
                                    <div>
                                        <ul class="pagination" id="pageIncome">

                                            <li class="page-item disabled pageIncome" aria-disabled="true" aria-label="« Previous">
                                                <a class="page-link" href="{{$incomes->previousPageUrl()}}">‹</a>
                                            </li>
                                            @foreach($incomes->getUrlRange(1, $incomes->lastPage()) as $index => $page)
                                                @if($index == $incomes->currentPage())
                                                        <li class="page-item active" aria-current="page"><span class="page-link">{{$index}}</span></li>
                                                    </a>
                                                @else
                                                    <li class="page-item pageIncome" id="{{$index}}"><a class="page-link" href="{{$page}}">{{$index}}</a></li>
                                                @endif
                                            @endforeach

                                            <li class="page-item pageIncome">
                                                <a class="page-link" href="{{$incomes->nextPageUrl()}}">›</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </nav>
{{--                            {{$incomes->appends(Request::all())->links()}}--}}
                        </div>
                        <div id="tableExpense" style="">
                            <table class="table" id="tbXp" >
                                <thead class="text-center">
                                <tr class="text-secondary">
                                    <td class="col-4" class="align-middle">Thời gian</td>
                                    <td class="col-4" class="align-middle">Loại khoản thu</td>
                                    <td class="col-4" class="align-middle">Số tiền</td>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($expenses as $expense)
                                    <tr>
                                        <td>
                                            <?php
                                            $x = Carbon::create($expense->dateTime);
                                            echo($x->format('d-m-Y'));
                                            ?>
                                        </td>
                                        <td>
                                            {{$expense->categoryExpense->name}}
                                        </td>
                                        <td class="text-end">
                                            <?php
                                            echo number_format($expense->amount);
                                            ?> VND
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <nav class="d-flex justify-items-center justify-content-between">
                                <div class="d-none flex-sm-fill d-sm-flex align-items-sm-center justify-content-sm-between">
                                    <div>
                                        <p class="small text-muted">
                                            Xem
                                            <span class="fw-semibold">{{$expenses->firstItem()}}</span>
                                            đến
                                            <span class="fw-semibold">{{$expenses->lastItem()}}</span>
                                            của
                                            <span class="fw-semibold">{{$expenses->total()}}</span>
                                            bản ghi
                                        </p>
                                    </div>
                                    <div>
                                        <ul class="pagination" id="pageExpense">

                                            <li class="page-item pageExpense" aria-disabled="true" aria-label="« Previous">
                                                <a class="page-link" href="{{$expenses->previousPageUrl()}}">‹</a>
                                            </li>
                                            @foreach($expenses->getUrlRange(1, $expenses->lastPage()) as $index => $page)
                                                @if($index == $expenses->currentPage())
                                                    <li class="page-item active" aria-current="page"><span class="page-link">{{$index}}</span></li>
                                                    </a>
                                                @else
                                                    <li class="page-item pageExpense" id="xp{{$index}}"><a class="page-link" href="{{$page}}">{{$index}}</a></li>
                                                @endif
                                            @endforeach

                                            <li class="page-item pageExpense">
                                                <a class="page-link" href="{{$expenses->nextPageUrl()}}">›</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </nav>
                        </div>
                    </div>

                </div>
            </div>

            <div class="col-5">
                <div class="row">
                    <div class="col bg-white" style="margin-left: 20px;margin-right: 20px;height: 50vh">
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
@section('modalBody')
    <div class="modal-body">
        <h5 class="modal-title fw-bold text-center" id="exampleModalLabel">Thêm hạn mức khoản chi</h5>

        <form method="post"  action="{{route('expenseLimit.store')}}">
            @csrf
            @method('POST')
            <div>
                <label for="name" class="col-md-12 mb-0 mt-2 " >Số tiền hạn mức</label>
                <div class="col-md-12">
                    <input type="number" class="form-control" name="limit" required min="0">
                </div>
                <div>
                    <label for="email" class="col-md-12 mb-0 mt-2">Ngày bắt đầu hạn mức</label>
                    <div class="col-md-12">
                        <input type="date" class="form-control" id="startDate" name="startDate" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <label for="password" class="col-md-12 mb-0 mt-2">Ngày kết thúc hạn mức</label>
                        <div class="col-md-12">
                            <input type="date" class="form-control" id="endDate" name="endDate" required onchange="checkEndDate('startDate','endDate')">
                        </div>
                    </div>
                </div>
                <div>
                    <label for="" class="col-md-12 mb-0 mt-2">Ghi chú</label>

                    <div class="col-md-12">
                        <input type="text" class="form-control" name="note">
                    </div>
                </div>
                <div>
                    <label for="" class="col-md-12 mb-0 mt-2"></label>

                    <div class="col-md-12">
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
@endsection

@section('modalEdit')
    <div class="modal-body">
        <h5 class="modal-title fw-bold text-center" id="exampleModalLabel">Sửa hạn mức khoản chi</h5>

        <form method="put"  action="#" id="editForm">
            @csrf
            @method('put')
            <input type="number" id="editLimitId" style="display: none">
            <div>
                <label for="name" class="col-md-12 mb-0 mt-2 " >Số tiền hạn mức</label>
                <div class="col-md-12">
                    <input type="number" class="form-control" name="limit" required min="0" id="limitEdit">
                </div>
                <div>
                    <label for="email" class="col-md-12 mb-0 mt-2">Ngày bắt đầu hạn mức</label>
                    <div class="col-md-12">
                        <input type="date" class="form-control" name="startDate" required id="startDateEdit">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <label for="password" class="col-md-12 mb-0 mt-2">Ngày kết thúc hạn mức</label>
                        <div class="col-md-12">
                            <input type="date" class="form-control" id="endDateEdit" name="endDate" required onchange="checkEndDate('startDateEdit','endDateEdit')">
                        </div>
                    </div>
                </div>
                <div>
                    <label for="" class="col-md-12 mb-0 mt-2">Ghi chú</label>
                    <div class="col-md-12">
                        <input type="text" class="form-control" name="note" id="noteEdit">
                    </div>
                </div>
                <div>
                    <label for="" class="col-md-12 mb-0 mt-2"></label>

                    <div class="col-md-12">
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
@endsection
@section('modalIndex')
    <div class="modal-body" id="tableLimit">
        <h5 class="modal-title fw-bold text-center" id="exampleModalLabel">Danh sách hạn mức khoản chi</h5>

        <table class="table">
            <thead>
            <tr class="text-secondary">
                <td scope="col" class="align-middle">Hạn mức</td>
                <td scope="col" class="align-middle">Ngày bắt đầu</td>
                <td scope="col" class="align-middle">Ngày kết thúc</td>
                <td></td>
            </tr>
            </thead>
            <tbody>
            @foreach($limits as $limit)
                <tr>
                    <td>
                        <?php
                        echo number_format($limit->limit);
                        ?> VND
                    </td>
                    <td>
                        {{$limit->startDate}}
                    </td>
                    <td>
                        {{$limit->endDate}}
                    </td>
                    <td>
                        <ul class="navbar navbar-expand-lg navbar-light" style="float: right;margin:0;">
                            <li class="nav-item active " style="list-style: none" data-toggle="modal"
                                data-target="#editModal" onclick="edit({{$limit}})">
                                <img src="{{ URL::to('/') }}/img/img_6.png" style="width: 22px; margin-right:20px"/>
                            </li>
                            <li class="nav-item active text-danger" style="list-style: none" data-toggle="modal"
                                data-target="#deleteModal"  onclick="deleteLimit({{$limit}})">
                                <img src="{{ URL::to('/') }}/img/img_7.png" style="width: 22px"/>
                            </li>
                        </ul>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        {{$limits->links()}}
    </div>
@endsection
@section('modalDelete')
    <div class="modal-body" id="deleteLimit">
        <h5 class="modal-title fw-bold text-center" id="exampleModalLabel">Xóa hạn mức khoản chi</h5>
<br><br><br>
        <form method="put"  action="#" id="deleteForm">
            @csrf
            @method('Delete')
            <input type="number" id="deleteLimitId" style="display: none">
            <div>
                <div class="col-md-12">
                    <p class="text-center">Bạn có muốn xóa hạn mức khoản chi không?</p>
                </div>


                <div class="col-md-12">
                    <div class="row justify-content-around">
                        <div class="col-4">
                            <button type="button" class="col btn btn-outline-primary mb-0 mt-2" data-dismiss="modal">
                                Hủy
                            </button>
                        </div>
                        <div class="col-4">
                            <button type="submit" class="col btn btn-danger mb-0 mt-2">Xóa</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
@section('script')
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
            document.getElementById('startDateEdit').value=limit.startDate;
            document.getElementById('endDateEdit').value=limit.endDate;
            document.getElementById('noteEdit').value=limit.note;
            document.getElementById('editLimitId').value=limit.id;
        }

        function deleteLimit(limit){
            document.getElementById('deleteLimitId').value=limit.id;
        }
    </script>
    <script>
        $('.pageIncome').on('click',function (e){
            e.preventDefault();
            var index = $(this).attr('id');
            $.ajax({
                type:'GET',
                url:'/dashboard?income='+index+'/',
                cache:false,
                success:function (){
                    $('#tbIc').load('dashboard?income='+index+'/ #tbIc');
                    $('#pageIncome').load('dashboard?income='+index+'/ #pageIncome');

                },
                error:function (){
                    alert('khong chay');
                }
            })
        })
        $('.pageExpense').on('click',function (e){
            e.preventDefault();
            var index = $(this).attr('id');
            index = index.substring(2);
            $.ajax({
                type:'GET',
                url:'/dashboard?expenses='+index+'/',
                cache:false,
                success:function (){
                    $('#tbXp').load('dashboard?expenses='+index+'/ #tbXp');
                    $('#pageExpense').load('dashboard?expenses='+index+'/ #pageExpense');

                },
                error:function (){
                    alert('khong chay');
                }
            })
        })
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
