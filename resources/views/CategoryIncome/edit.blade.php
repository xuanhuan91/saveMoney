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
        <form action="{{ route('CategoryIncome.update',$ctincome->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="amount">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="{{old('name',$ctincome->name) }}" placeholder="Enter name"/>
            </div>
            <div class="form-group">
                <label for="note">Thành Phần loại Khoản Thu</label>
                <textarea type="text" class="form-control" name="Subname">{{old('Subname',$ctincome->subCategoryiD) }}</textarea>
            </div>
            <button type="submit" class="btn btn-primary">Save</button>
        </form>
    </div>

@endsection

