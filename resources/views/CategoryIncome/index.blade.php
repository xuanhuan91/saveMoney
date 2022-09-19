@extends('layouts.app')
@section('content')
    <div style="margin: 30px">
        <h1 class="display-7">Quản lý loại khoản thu</h1>
        <div>
            <a class="btn btn-primary" href="{{route('CategoryIncome.create')}}">Add CategoryIncome</a>
        </div>

        <table class="table">
            <thead class="thead-dark">
            <tr>
                <th scope="col">Tên loại khoản thu</th>
                <th scope="col">Khoản thu con</th>
                <th scope="col">Thời gian tạo</th>
                <th scope="col">Sửa</th>
                <th scope="col">Xóa</th>
                <th scope="col">Note</th>
            </tr>
            </thead>
            <tbody>
            @foreach($lsCategoryIncome as $parentIncome)
                <tr>
                    <td>{{$parentIncome->name}}</td>
                    <td>{{$parentIncome->note}}</td>
                    @if(count($$parentIncome->subcategory))
                        <td>
                            @include('CategoryIncome.sub_category_list',['subcategories' => $parentIncome->subcategory])
                        </td>
                    @endif
                    <td>{{$parentIncome->created_at}}</td>
                    <td>
                        <div class="input-group">
                            <a class="btn btn-warning" href="{{route("CategoryIncome.edit", $parentIncome->id)}}">Edit</a>

                            <form method="post" action="{{route('CategoryIncome.destroy', $parentIncome->id)}}"
                                  onsubmit='return confirm("Are you sure ?")'>
                                @csrf
                                @method('DELETE')
                                <input type="submit" value="Delete" class="btn btn-danger">
                            </form>
                        </div>
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
