@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Expense manager</h2>
{{--        <form action="/search" method="POST" role="search">--}}
{{--            {{ csrf_field() }}--}}
{{--            <div class="input-group">--}}
{{--                <input type="text" class="form-control" name="search1"--}}
{{--                       placeholder="Search IncomeCategory"> <span class="input-group-btn">--}}
{{--            <button type="submit" class="btn btn-default">--}}
{{--                <span class="glyphicon glyphicon-search">--}}
        <div class="row">
            <div class="col">
                <input type="text" class="form-control" placeholder="Type of Expense" aria-label="Type of Expense">
            </div>
            <div class="col">
                <input type="text" class="form-control" placeholder="Time" aria-label="Time">
            </div>
            <div class="col-auto">
                <button type="submit" class="btn btn-primary">Search</button>
            </div>
        </div>

        <div>
            <a class="btn btn-primary" href="{{route('expense.create')}}">Add Expense</a>
        </div>


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
                <th>Time</th>
                <th>Amount</th>
                <th>Type Of Expense</th>
                <th>Components Of Expense Type</th>
                <th>Note</th>
                <th>Action</th>
            </tr>
            @foreach($lsExpense as $expense)
                <tr>
                    <td>{{$expense->dateTime}}</td>
                    <td>{{$expense->amount}}</td>
                    <td>{{$expense->type}}</td>
                    <td>{{$expense->components}}</td>
                    <td>{{$expense->note}}</td>
                    <td>
                        <a class="btn btn-primary" href='{{route("expense.edit", $expense->id)}}'>Edit</a> |

                        <form method="post" action="{{route('expense.destroy', $expense->id)}}"
                              onsubmit='return confirm("Sure ?")'>
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
            var value =  confirm("Sure ?");
            return value;
        }
    </script>
@endsection
