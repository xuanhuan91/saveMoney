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
        <form method="post" action="{{route('CategoryExpense.store')}}">
            @csrf
            <div class="form-group">--}}
                <label for="name">Tên Loại Khoản Chi</label>
                <input type="text" class="form-control" id="name" name="name" value="{{old('name',$ctexpense->name) }}" placeholder="Enter name"/>
            </div>
            <div class="form-group">
                <label for="subCategoryiD">Thành Phần loại Khoản Chi </label>
                <input type="text" class="form-control" id="subCategoryiD" name="subCategoryiD"{{old('subCategoryiD',$ctexpense->subCategoryiD) }}/>
            </div>
            <div>
                <input style="margin-right: 15px" type="submit" class="btn btn-primary " value="Save">
                <a
                    class="btn btn-info"   href='{{route("CategoryExpense.index")}}'
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
@section('content')
@endsection

