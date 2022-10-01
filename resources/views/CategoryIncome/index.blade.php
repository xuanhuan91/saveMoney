@extends('layouts.app')
@section('scriptSrc')
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
@endsection
@section('content')
    <div class="container" style="margin-top: 40px">
        <h2>Quản lý Loại Khoản Thu </h2>
        <div>
            <a>
               <button class="btn btn-primary btn-block " style="width: 10%; float: right"
                            data-toggle="modal"
                            data-target="#exampleModal">Thêm
               </button>
            </a>
        </div>
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
            <thead class="thead-dark">
            <tr>
                <th scope="col">Tên loại khoản thu</th>
                <th scope="col">Thành Phần Loại Khoản Thu</th>
                <th scope="col">Thời gian tạo</th>
                <th class="text-center" >Sửa</th>
                <th class="text-center">Xóa</th>
            </tr>
            </thead>
            <tbody>
            @foreach($lsCategoryIncome as $parentIncome)
                <tr>
                    <td>{{$parentIncome->name}}</td>
                    <td>{{$parentIncome->subCategoryiD}}</td>
                    <td>{{$parentIncome->created_at}}</td>
                    <td class="text-lg-center" style="width: 20%">
                    <a data-target="#editModal" data-toggle="modal" onclick="getIncome({{$parentIncome->id}})"
                               class="btn btn-primary"
                        >Edit</a>
                    </td>
                            <span style="margin-left: 20px"></span>
                    <td class="text-center"><form method="post" action="{{route('CategoryIncome.destroy', $parentIncome->id)}}" onsubmit='return confirm("Xác nhận xóa thông tin ?")'>
                            @csrf
                            @method('DELETE')
                            <input class="btn btn-danger" type="submit" value="Delete" >
                        </form>
                    </td>
                </tr>
            @endforeach
        </table>

    </div>

    <script type="text/javascript">
        function confirmDelete() {
            var value = confirm("Xác nhận xóa thông tin ?");
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
        <form method="post" action="{{route('CategoryIncome.store')}}">
            @csrf
            <div class="form-group">
                <label for="name">Tên Loại Khoản Thu</label>
                <input type="text" class="form-control" id="name" name="name" value="{{old('name') }}" placeholder="Enter name"/>
            </div>
            <div class="form-group">
                <label for="subCategoryiD">Thành Phần loại Khoản Thu </label>
                <input type="text" class="form-control" id="subCategoryiD" name="subCategoryiD"{{old('subCategoryiD') }}/>
            </div>
            <div>
                <input style="margin-right: 15px" type="submit" class="btn btn-primary " value="Save">
                <a
                    class="btn btn-info"   href='{{route("CategoryIncome.index")}}'
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
            <form method="post" action="{{ route('CategoryIncome.update', ['id'=>$parentIncome->id]) }}" id="editForm">
                @csrf
                @method('put')
                <input type="number" id="idIncomeEdit">
                <div class="form-group">
                    <label for="name">Tên Loại Khoản Thu</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{old('name',$parentIncome->name) }}" placeholder="Enter name"/>
                </div>
                <div class="form-group">
                    <label for="subCategoryiD">Thành Phần loại Khoản Thu </label>
                    <input type="text" class="form-control" id="subCategoryiD" name="subCategoryiD" value="{{old('subCategoryiD',$parentIncome->subCategoryiD) }}"/>
                </div>
                <div>
                    <input style="margin-right: 15px" type="submit" class="btn btn-primary " value="Save">
                    <a
                        class="btn btn-info"   href='route("CategoryIncome.index")'
                        style=" --bs-btn-color: #fff;
                                                    --bs-btn-bg: #0d6efd;
                                                    --bs-btn-border-color: #0a58ca;
                                                    --bs-btn-hover-color: #fff;
                                                    --bs-btn-hover-bg: red;
                                                    --bs-btn-hover-border-color: red;
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
            </form>
{{--        <div id="testIncome">--}}

{{--        </div>--}}

    </div>
    <script  type="text/javascript">
        function getID(){
            var editId = document.getElementsByClassName('btn btn-info');
            console.log(editId)
        }
    </script>
@endsection
<script>
    function getIncome(id) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: `/getIncome/${id}`,
            method: 'GET',
            success: (e) => {
                const html = e.map(data => {
                    return `
                    <form method="post" action=" route('CategoryIncome.update', ['id'=>${data.id}])" id="editForm">
                        <input type="number" id="idIncomeEdit">
                        <div class="form-group">
                            <label for="name">Tên Loại Khoản Thu</label>
                            <input type="text" class="form-control" id="name" name="name" value="${data.id}" placeholder="Enter name"/>
                        </div>
                        <div class="form-group">
                            <label for="subCategoryiD">Thành Phần loại Khoản Thu </label>
                            <input type="text" class="form-control" id="subCategoryiD" name="subCategoryiD" value="${data.subCategoryiD}"/>
                        </div>
                        <div>
                            <input style="margin-right: 15px" type="submit" class="btn btn-primary " value="Save">
                            <a
                                class="btn btn-info"   href='route("CategoryIncome.index")'
                                style=" --bs-btn-color: #fff;
                                                    --bs-btn-bg: #0d6efd;
                                                    --bs-btn-border-color: #0a58ca;
                                                    --bs-btn-hover-color: #fff;
                                                    --bs-btn-hover-bg: red;
                                                    --bs-btn-hover-border-color: red;
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
                    </form>
                    `
                    console.log()
                    document.getElementById("testIncome").innerHTML = html
                })
                // e là dữ liệu có id = id
            }
        })
    }

</script>
