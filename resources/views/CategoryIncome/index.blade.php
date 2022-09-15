@extends('layouts.app')
@section('content')
    {{--        <ul>--}}
    {{--            <li>--}}
    {{--                <a href="{{route('CategoryExpense.create')}}"><button class="btn btn-warning">New category</button></a>--}}
    {{--            </li>--}}
    {{--        </ul>--}}
    {{--        @foreach($parentCategoryExpense as $parentCategory)--}}
    {{--            <ul class="list-group">--}}
    {{--                <li class="list-group-item"><a>{{$parentCategory->name}}</a>--}}
    {{--                <li class="list-group-item">--}}
    {{--                    @if(count($parentCategory->subcategory))--}}
    {{--                        @include('CategoryExpense.sub_category_list',['subcategories' => $parentCategory->subcategory])--}}
    {{--                    @endif--}}
    {{--                </li>--}}
    {{--                </li>--}}
    {{--            </ul>--}}
    {{--        @endforeach--}}
    <div style="margin: 30px">
        <h1 class="display-7">Quản lý loại khoản thu</h1>
        <h4 class="text-right"><button class="btn btn-warning">Thêm</button></h4>

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
            @foreach($parentCategoryIncome as $parentCategory)
                <tr>
                    <td>{{$parentCategory->name}}</td>
{{--                    @if(count($parentCategory->subcategory))--}}
                        <td>
{{--                            @include('CategoryIncome.sub_category_list',['subcategories' => $parentCategory->subcategory])--}}
                        </td>
{{--                    @endif--}}
                    <td>{{$parentCategory->created_at}}</td>
                    <td><a class="btn btn-warning">Edit</a></td>
                    <td>
                        <form method="post" action="{{route('CategoryIncome.destroy', $parentCategory->id)}}"
                              onsubmit='return confirm("Are you sure ?")'>
                            @csrf
                            @method('DELETE')
                            <input type="submit" value="Delete" class="btn btn-danger">
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
