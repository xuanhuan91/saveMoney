@extends('layouts.app')

@section('content')
    <div class="container" style="margin-top: 40px">
        <h2>Quản lý Khoản Thu </h2>
        <div>
            <a>
               <button class="btn btn-primary btn-block " style="width: 10%; float: right"
                            data-toggle="modal"
                            data-target="#exampleModal">Thêm
               </button>
            </a>
        </div>
        <br>
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
                    <a data-target="#editModal" data-toggle="modal" onclick="getExpense({{$parentIncome}})"
                               class="btn btn-warning"   href='#'
                        >Edit</a>
                    </td>
                            <span style="margin-left: 20px"></span>
                    <td class="text-center"><form method="post" action="{{route('CategoryIncome.destroy', $parentIncome->id)}}" onsubmit='return confirm("You want to delete ??")'>
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
            var value = confirm("You want to delete ?");
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
        <form method="post" action="#" id="editForm">
            @csrf
            @method('PUT')
            <input type="number" id="idIncomeEdit">
            <div class="form-group">
                <label for="name">Tên Loại Khoản Thu</label>
                <input type="text" class="form-control" id="name" name="name" value="{{old('name',$parentIncome->name) }}" placeholder="Enter name"/>
            </div>
            <div class="form-group">
                <label for="subCategoryiD">Thành Phần loại Khoản Thu </label>
                <input type="text" class="form-control" id="subCategoryiD" name="subCategoryiD"{{old('subCategoryiD',$parentIncome->subCategoryiD) }}/>
            </div>
            <div>
                <input style="margin-right: 15px" type="submit" class="btn btn-primary " value="Save">
                <a
                    class="btn btn-info"   href='{{route("CategoryIncome.index")}}'
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
    </div>
    <script  type="text/javascript">
        function getID(){
            var editId = document.getElementsByClassName('btn btn-info');
            console.log(editId)
        }
    </script>
@endsection

{{--@extends('layouts.app')--}}
{{--@section('content')--}}
{{--    <div style="margin: 30px">--}}
{{--        <h1 class="display-7">Quản lý loại khoản thu</h1>--}}
{{--        <div>--}}
{{--            <a href="{{route('CategoryIncome.create')}}">--}}
{{--                <h4 class="text-xl-right">--}}
{{--                    <button class="btn btn-primary">Thêm</button>--}}
{{--                </h4>--}}
{{--            </a>--}}
{{--        </div>--}}

{{--        <table class="table">--}}
{{--            <thead class="thead-dark">--}}
{{--            <tr>--}}
{{--                <th scope="col">Tên loại khoản thu</th>--}}
{{--                <th scope="col">Thành Phần Loại Khoản Thu</th>--}}
{{--                <th scope="col">Thời gian tạo</th>--}}
{{--                <th class="text-right">Sửa</th>--}}
{{--                <th class="text-md-center">Xóa</th>--}}
{{--            </tr>--}}
{{--            </thead>--}}
{{--            <tbody>--}}
{{--            @foreach($lsCategoryIncome as $parentIncome)--}}
{{--                <tr>--}}
{{--                    <td>{{$parentIncome->name}}</td>--}}
{{--                    <td>{{$parentIncome->subCategoryiD}}</td>--}}
{{--                    <td>{{$parentIncome->created_at}}</td>--}}
{{--                    <td class="text-right">--}}
{{--                        <a  class="btn btn-warning" href="{{route("CategoryIncome.edit", $parentIncome->id)}}">Edit</a>--}}
{{--                        <td class="text-xl-center"><form method="post" action="{{route('CategoryIncome.destroy', $parentIncome->id)}}"--}}
{{--                                  onsubmit='return confirm("Are you sure ?")'>--}}
{{--                                @csrf--}}
{{--                                @method('DELETE')--}}
{{--                                <input type="submit" value="Delete" class="btn btn-danger">--}}
{{--                            </form></td>--}}
{{--                    </td>--}}
{{--                </tr>--}}
{{--            @endforeach--}}
{{--            </tbody>--}}
{{--        </table>--}}
{{--    </div>--}}
{{--    <script type="text/javascript">--}}
{{--        function confirmDelete() {--}}
{{--            var value =  confirm("Sure ?");--}}
{{--            return value;--}}
{{--        }--}}
{{--    </script>--}}
{{--@endsection--}}
{{--@section('modalBody')--}}
{{--    <div class="modal-body">--}}
{{--        <h5 class="modal-title fw-bold text-center" id="exampleModalLabel">Edit CategoryIncome</h5>--}}

{{--        <form method="post"  action="{{route('CategoryIncome.update',$parentIncome->id)}}">--}}
{{--            @csrf--}}
{{--            @method('put')--}}
{{--            <div>--}}
{{--                <div>--}}
{{--                    <label for="name" class="col-md-12 mb-0 mt-2">{{ __('Name') }}</label>--}}
{{--                    <div class="col-md-12">--}}
{{--                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name"--}}
{{--                               value="{{ old('name',$parentIncome->name) }}" required autocomplete="name" autofocus>--}}

{{--                        @error('name')--}}
{{--                        <span class="invalid-feedback" role="alert">--}}
{{--                                                <strong>{{ $message }}</strong>--}}
{{--                                            </span>--}}
{{--                        @enderror--}}
{{--                    </div>--}}
{{--                </div>--}}

{{--                <div>--}}
{{--                    <label for="subCategoryiD" class="col-md-12 mb-0 mt-2">{{ __('subCategoryiD') }}</label>--}}

{{--                    <div class="col-md-12">--}}
{{--                        <input id="subCategoryiD" type="text" class="form-control @error('subCategoryiD') is-invalid @enderror"--}}
{{--                               name="subCategoryiD" value="{{ old('subCategoryiD',$parentIncome->subCategoryiD) }}" required autocomplete="subCategoryiD">--}}

{{--                        @error('subCategoryiD')--}}
{{--                        <span class="invalid-feedback" role="alert">--}}
{{--                                            <strong>{{ $message }}</strong>--}}
{{--                                            </span>--}}
{{--                        @enderror--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="col-md-12">--}}
{{--                    <div class="row justify-content-around">--}}
{{--                        <div class="col-4">--}}
{{--                            <button type="button" class="col btn btn-outline-primary mb-0 mt-2" data-dismiss="modal">--}}
{{--                                Cacel--}}
{{--                            </button>--}}
{{--                        </div>--}}
{{--                        <div class="col-4">--}}
{{--                            <button type="submit" class="col btn btn-primary mb-0 mt-2">Save</button>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </form>--}}
{{--    </div>--}}
{{--@endsection--}}
