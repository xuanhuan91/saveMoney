@extends('layouts.app')
@section('content')
    <div style="margin: 30px">
        <h1 class="display-7">Quản lý loại khoản thu</h1>
        <div>
            <a href="{{route('CategoryIncome.create')}}">
                <h4 class="text-light">
                    <button class="btn btn-primary">Add CategoryIncome</button>
                </h4>
            </a>
        </div>

        <table class="table">
            <thead class="thead-dark">
            <tr>
                <th scope="col">Tên loại khoản thu</th>
                <th scope="col">Khoản thu con</th>
                <th scope="col">Thời gian tạo</th>
                <th scope="col">Sửa</th>
                <th scope="col">Xóa</th>
            </tr>
            </thead>
            <tbody>
            @foreach($lsCategoryIncome as $parentIncome)
                <tr>
                    <td>{{$parentIncome->name}}</td>
                    <td>{{$parentIncome->subCategoryiD}}</td>
{{--                    @if(count($parentIncome->subcategory))--}}
{{--                        <td>@include('CategoryIncome.sub_category_list',['$subcategoryiD' => $subcategory->subcategory])</td>--}}
{{--                    @endif--}}
                    <td>{{$parentIncome->created_at}}</td>
                    <td>
                        <a class="btn btn-warning" href="{{route("CategoryIncome.edit", $parentIncome->id)}}">Edit</a>
                        <td><form method="post" action="{{route('CategoryIncome.destroy', $parentIncome->id)}}"
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
{{--                    <label for="note" class="col-md-12 mb-0 mt-2">{{ __('Note') }}</label>--}}

{{--                    <div class="col-md-12">--}}
{{--                        <input id="note" type="text" class="form-control @error('note') is-invalid @enderror"--}}
{{--                               name="note" value="{{ old('note',$parentIncome->note) }}" required autocomplete="note">--}}

{{--                        @error('note')--}}
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
