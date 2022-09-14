@extends('layouts.app')

@section('content')
    <div class="container">
        <h4>Quản lý Khoản Thu </h4>

{{--         search khoan thu--}}
        <div style="width: 15rem; margin: auto">
            <form method="post" action="{{route('search')}}">
                @csrf
                <div class="form-group">
                    <label for="title">Loại khoản thu</label>
                    <input type="text" class="form-control" name="title" value="{{old('title')}}">

                    <label for="title">Thời gian</label>
                    <input type="date" class="form-control" name="datetime" value="{{old('datetime')}}">

                </div>

                <div>
                    <input style="margin: 10px" type="submit" class="btn btn-warning" value="Search">
                </div>

            </form>
        </div>

{{--        End Search--}}

        <p>
            <a class="btn btn-success" href="{{route('income.create')}}">Add New Income</a>
            {{--            <a class="btn btn-success" href="">Add New Income</a>--}}
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
                <th>Thời gian</th>
                <th>Loại khoản thu</th>
                <th>Số tiền</th>
                <th>Lựa chọn loại khoản thu</th>
                <th>Ghi chú</th>
                <th>Actor</th>
            </tr>
            @foreach($lsincome as $income)
                <tr>
                    <td>{{$income->dateTime}}</td>
                    <td>
                    @foreach($lscategoryincome as $categoryincome)
                        @if($categoryincome->id == $income->categoryincome->subCategoryiD)
                              {{ $categoryincome->name}}
                            @endif
                     @endforeach
                    </td>
                    <td>{{$income->amount}}</td>
                    <td>{{$income->categoryincome->name}}</td>
                    <td>{{$income->note}}</td>

                    <td>
                        <a class="btn btn-dark" href='{{route("income.edit", $income->id)}}'>Edit</a> |
                        <form method="post" action="{{route('income.destroy', $income->id)}}"
                              onsubmit='return confirm("You want to delete ? ")'>
                            @csrf
                            @method('DELETE')
                            <input type="submit" value="Delete" class="btn btn-danger">
                        </form>
                    </td>
                </tr>
            @endforeach
        </table>
    </div>

    <script type="text/javascript">
        function confirmDelete() {
            var value = confirm("You want to delete ? ");
            return value;
        }
    </script>
@endsection
