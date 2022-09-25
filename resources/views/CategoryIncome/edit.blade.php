@extends('layouts.app')


@section('content')
    <div class="container">
        <h4>Edit new CategoryIncome </h4>
        <div class="container">
            @if(count($errors) > 0)
                <div class="alert alert-danger">
                    @foreach($errors->all() as $err)
                        <p>{{$err}}</p>
                    @endforeach
                </div>
            @endif
        </div>
        <form action="{{ route('CategoryIncome.update',$ctincome) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="name">Tên Loại Khoản Thu</label>
                <input type="text" class="form-control" id="name" name="name" value="{{old('name',$ctincome->name) }}" placeholder="Enter name"/>
            </div>
            <div class="form-group">
                <label for="subCategoryiD">Thành Phần loại Khoản Thu </label>
                <input type="text" class="form-control" id="subCategoryiD" name="subCategoryiD"{{old('subCategoryiD',$ctincome->subCategoryiD) }}/>
            </div>
            <div class="form-group py-lg-2">
                <input type="submit" class="btn btn-primary" value="Save"/>
                <input href="CategoryIncome.index" type="submit" class="btn btn-danger" value="Cancel"/>
            </div>
        </form>
    </div>

@endsection

