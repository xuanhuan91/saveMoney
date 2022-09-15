@extends('layouts.app')

@section('content')
    <div class="container">
        <h3>Thêm Khoản Thu </h3>
        <p>
{{--            <a href="{{route('category.create')}}">Add New Income</a>--}}
                        <a class="btn btn-success" href="">Add New Income</a>
        </p>

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
            <tr>
                <th>Số tiền</th>
                <th>Lựa chọn loại khoản thu</th>
                <th>Lựa chọn thành phần loại khoản thu</th>
                <th>Ghi chú</th>
                <th>Thời gian</th>

            </tr>

{{--            @foreach($lsCate as $cate)--}}
{{--                <tr>--}}
{{--                    <td>{{$cate->name}}</td>--}}
{{--                    <td>{{$cate->note}}</td>--}}
{{--                    <td>--}}
{{--                        <a class="btn btn-dark" href='{{route("category.edit", $cate->id)}}'>Edit</a> |--}}
{{--                        <form method="post" action="{{route('category.destroy', $cate->id)}}" onsubmit='return confirm("sure ?")'>--}}
{{--                            @csrf--}}
{{--                            @method('DELETE')--}}
{{--                            <input type="submit" value="Delete" class="btn btn-danger">--}}
{{--                        </form>--}}
{{--                    </td>--}}
{{--                </tr>--}}
{{--            @endforeach--}}
        </table>
    </div>


    <script type="text/javascript">
        function confirmDelete(){
            var value = confirm("sure ? ");
            return value;
        }

    </script>
@endsection
