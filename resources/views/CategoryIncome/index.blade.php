@extends('layouts.app')
@section('content')
    <div style="margin: 30px">
        <h1 class="display-7">Quản lý loại khoản thu</h1>
        <div>
            <a href="{{route('CategoryIncome.create')}}">
                <h4 class="text-xl-right">
                    <button class="btn btn-primary">Thêm</button>
                </h4>
            </a>
        </div>

        <table class="table">
            <thead class="thead-dark">
            <tr>
                <th scope="col">Tên loại khoản thu</th>
                <th scope="col">Thành Phần Loại Khoản Thu</th>
                <th scope="col">Thời gian tạo</th>
                <th class="text-right">Sửa</th>
                <th class="text-md-center">Xóa</th>
            </tr>
            </thead>
            <tbody>
            @foreach($lsCategoryIncome as $parentIncome)
                <tr>
                    <td>{{$parentIncome->name}}</td>
                    <td>{{$parentIncome->subCategoryiD}}</td>
                    <td>{{$parentIncome->created_at}}</td>
                    <td class="text-right">
                        <a  class="btn btn-warning" href="{{route("CategoryIncome.edit", $parentIncome->id)}}">Edit</a>
                        <td class="text-xl-center"><form method="post" action="{{route('CategoryIncome.destroy', $parentIncome->id)}}"
                                  onsubmit='return confirm("Are you sure ?")'>
                                @csrf
                                @method('DELETE')
                                <input type="submit" value="Delete" class="btn btn-danger">
                            </form></td>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <script type="text/javascript">
        function confirmDelete() {
            var value =  confirm("Sure ?");
            return value;
        }
    </script>
@endsection
@section('modalBody')
    <div class="modal-body">
        <h5 class="modal-title fw-bold text-center" id="exampleModalLabel">Edit CategoryIncome</h5>

        <form method="post"  action="{{route('CategoryIncome.update',$parentIncome->id)}}">
            @csrf
            @method('put')
            <div>
                <div>
                    <label for="name" class="col-md-12 mb-0 mt-2">{{ __('Name') }}</label>
                    <div class="col-md-12">
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                               value="{{ old('name',$parentIncome->name) }}" required autocomplete="name" autofocus>

                        @error('name')
                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                        @enderror
                    </div>
                </div>

                <div>
                    <label for="subCategoryiD" class="col-md-12 mb-0 mt-2">{{ __('subCategoryiD') }}</label>

                    <div class="col-md-12">
                        <input id="subCategoryiD" type="text" class="form-control @error('subCategoryiD') is-invalid @enderror"
                               name="subCategoryiD" value="{{ old('subCategoryiD',$parentIncome->subCategoryiD) }}" required autocomplete="subCategoryiD">

                        @error('subCategoryiD')
                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                            </span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="row justify-content-around">
                        <div class="col-4">
                            <button type="button" class="col btn btn-outline-primary mb-0 mt-2" data-dismiss="modal">
                                Cacel
                            </button>
                        </div>
                        <div class="col-4">
                            <button type="submit" class="col btn btn-primary mb-0 mt-2">Save</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
