@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Expense manager</h2>
        <div class="container">
            <form action="{{url('/search')}}" method="POST" role="search">
                {{csrf_field()}}
                <div class="input-group">
                     <input type="text" class="form-control" name="q" placeholder="Type Of Expense">
                    <input type="text" class="form-control" name="q" placeholder="Time">
                    <span class="input-group-btn">
                       <button type="submit" class="btn btn-info">
                           <a class="fas fa-search fa-sm" href="{{route('expense.index')}}"></a> Search
                       </button>
                     </span>

                </div>
            </form>
        </div>

        <br><br>


{{--            <div>--}}
{{--                <button class="btn btn-primary btn-block" href='{{route("expense.create")}}' style="width: 20%" data-toggle="modal"--}}
{{--                    data-target="#exampleModal">Add Expense--}}
{{--                </button>--}}

            <a class="btn btn-primary" href="{{route('expense.create')}}">Add Expense</a>
            </div>

        <br>






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
            @foreach($lsExpense as $expense )
                <tr>
                    <td>{{$expense->dateTime}}</td>
                    <td>{{$expense->amount}}</td>
                    <td>{{$expense->type}}</td>
                    <td>{{$expense->components}}</td>
                    <td>{{$expense->note}}</td>
                    <td>
                        <div class="input-group">
{{--                            <a class="btn btn-primary" href='{{route("expense.edit", $expense->id)}}'>Edit</a>--}}
                            <button class="btn btn-primary btn-block" href='{{route("expense.edit", $expense->id)}}' style="width: 40%" data-toggle="modal"
                                    data-target="#exampleModal">Edit
                            </button>
{{--                            <button class="btn btn-primary btn-block" href='{{route("expense.create", $expense->id)}}' style="width: 40%" data-toggle="modal"--}}
{{--                                    data-target="#exampleModal">Create--}}
{{--                            </button>--}}


                            <form method="post" action="{{route('expense.destroy', $expense->id)}}"
                                  onsubmit='return confirm("Sure ?")'>
                                @csrf
                                @method('DELETE')
                                <input class="btn btn-danger btn-block" style="width: 100%" data-toggle="modal" type="submit"

                                       value="Delete" >
                            </form>
                        </div>

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

@section('modalBody')
    <div class="modal-body">
        <h5 class="modal-title fw-bold text-center" id="exampleModalLabel">Edit Expense</h5>

        <form method="post"  action="{{route('expense.update',$expense->id)}}">
            @csrf
            @method('put')
            <div>
                <div>
                  <label for="name" class="col-md-12 mb-0 mt-2">{{ __('Amount') }}</label>
                  <div class="col-md-12">
                    <input id="amount" type="text" class="form-control @error('amount') is-invalid @enderror" name="amount"
                           value="{{ old('amount',$expense->amount) }}" required autocomplete="amount" autofocus>

                    @error('amount')
                    <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                    @enderror
                  </div>
                 </div>

                <div>
                    <label for="note" class="col-md-12 mb-0 mt-2">{{ __('Note') }}</label>

                    <div class="col-md-12">
                        <input id="note" type="text" class="form-control @error('note') is-invalid @enderror"
                               name="note" value="{{ old('note',$expense->note) }}" required autocomplete="note">

                        @error('note')
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


@section('modalBody')
    <div class="modal-body">
        <h5 class="modal-title fw-bold text-center" id="exampleModalLabel">Add Expense</h5>

        <form method="post"  action="{{route('expense.store',$expense->id)}}">
            @csrf
            @method('put')
            <div>
                <label for="name" class="col-md-12 mb-0 mt-2">{{ __('Amount') }}</label>
                <div class="col-md-12">
                    <input id="amount" type="text" class="form-control @error('amount') is-invalid @enderror" name="amount"
                           value="{{ old('amount',$expense->amount) }}" required autocomplete="amount" autofocus>

                    @error('amount')
                    <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                    @enderror
                </div>
                <div>
                    <label for="categoryExpenseId" class="col-md-12 mb-0 mt-2">{{ __('Category Expense Id') }}</label>

                    <div class="col-md-12">
                        <input id="categoryExpenseId" type="text" class="form-control @error('categoryExpenseId') is-invalid @enderror"
                               name="categoryExpenseId" value="{{ old('categoryExpenseId',$expense->categoryExpenseId) }}" required autocomplete="categoryExpenseId">

                        @error('categoryExpenseId')
                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                            </span>
                        @enderror
                    </div>
                </div>
                <div>
                    <label for="note" class="col-md-12 mb-0 mt-2">{{ __('Note') }}</label>

                    <div class="col-md-12">
                        <input id="note" type="note" class="form-control @error('note') is-invalid @enderror"
                               name="note" value="{{ old('note',$expense->note) }}" required autocomplete="note">

                        @error('note')
                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                            </span>
                        @enderror
                    </div>
                </div>
                <div>
                    <label for="dateTime" class="col-md-12 mb-0 mt-2">{{ __('DateTime') }}</label>

                    <div class="col-md-12">
                        <input id="dateTime" type="text" class="form-control @error('dateTime') is-invalid @enderror"
                               name="dateTime" value="{{ old('dateTime',$expense->dateTime) }}" required autocomplete="dateTime">

                        @error('dateTime')
                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                            </span>
                        @enderror
                    </div>
                <div class="col-md-12">
                    <div class="row justify-content-around">
                        <div class="col-4">
                            <button type="button" class="col btn btn-outline-primary mb-0 mt-2" data-dismiss="modal">
                                Cancel
                            </button>
                        </div>
                        <div class="col-4">
                            <button type="submit" class="col btn btn-primary mb-0 mt-2">Save</button>
                        </div>
                    </div>
                </div>
                </div>
            </div>
        </form>
    </div>
@endsection
