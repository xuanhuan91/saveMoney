@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Báo cáo {{''}}</h1>
    <ul class="nav border-bottom mb-5">
        @if(request()->expenseReport)
            <li class="nav-item">
                <a href="/report/week" class="nav-link px-0 me-2 text-secondary" href="#">Danh sách khoản thu</a>
            </li>
            <li class="nav-item border-bottom border-primary">
                <a href="?expenseReport=true" class="nav-link" href="#">Danh sách khoản chi</a>
            </li>
        @else
            <li class="nav-item border-bottom border-primary">
                <a href="/report/week" class="nav-link px-0 me-2" href="#">Danh sách khoản thu</a>
            </li>
            <li class="nav-item">
                <a href="?expenseReport=true" class="nav-link text-secondary" href="#">Danh sách khoản chi</a>
            </li>
        @endif

    </ul>

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="bg-white">
                <table class="table">
                    <thead>
                    <tr class="text-secondary">
                        <td scope="col" class="align-middle">Thời gian</td>
                        <td scope="col" class="align-middle">Loại khoản thu</td>
                        <td scope="col" class="align-middle">Lựa chọn thành phần loại khoản thu</td>
                        <td scope="col" class="align-middle">Số tiền</td>
                        <td scope="col" class="align-middle">Ghi chú</td>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($data as $row)
                        <tr class="text-secondary">
                            <td>{{\Carbon\Carbon::parse($row->dateTime)->format('d/m/Y')}}</td>
                            @if(request()->expenseReport)
                                @if(!empty($row->categoryExpense))
                                    <td>
                                        <div class="text-dark font-weight-bold">{{$row->categoryExpense->name}}</div>
                                    </td>
                                @else
                                    <td></td>
                                @endif
                            @else
                                @if(!empty($row->categoryIncome))
                                    <td>
                                        <div class="text-dark font-weight-bold">{{$row->categoryIncome->name}}</div>
                                    </td>
                                @else
                                    <td></td>
                                @endif
                            @endif
                            {{-- @if(!empty($row->categoryExpense) && !!count($row->categoryExpense->subcategory))
                                <td>
                                @php
                                    $color = Config::get('color');
                                    $colorNumber = count($color);
                                    $increNumber = 0;
                                @endphp
                                @foreach($row->categoryExpense->subcategory as $category)
                                    <span class="badge bg-{{$color[$increNumber++]}} rounded-pill">
                                        {{$category->name}}
                                    </span>
                                    @if($increNumber == 9)
                                        {{ $increNumber = 1 }}
                                    @endif
                                @endforeach
                                </td>
                            @else
                                <td></td>
                            @endif --}}
                            <td></td>
                            <td>{{number_format($row->amount, 0)}}</td>
                            <td>{{$row->note}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="d-flex align-items-center justify-content-center">
                    <div class="mb-4">
                        <a href="?page=1" class="btn rounded border" style="font-size:16px; padding: 5px 15px;">&laquo;</a>
                        <a href="{{$data->previousPageUrl()}}" class="btn rounded border" style="font-size:16px; padding: 5px 15px;">&lsaquo;</a>
                        @foreach($data->getUrlRange($data->currentPage(), $data->currentPage() + 5 > $data->lastPage() ? $data->lastPage() : $data->currentPage() + 5) as $index => $page)
                            @if($index == $data->currentPage())
                                <a href="#" class="btn rounded border" style="font-size:16px; padding: 5px 15px; color: #109CF1; background: #CDE9FA;                                ">
                                    {{$index}}
                                </a>
                            @else
                                <a href="{{$page}}" class="btn rounded border" style="font-size:16px; padding: 5px 15px;">
                                    {{$index}}
                                </a>
                            @endif
                        @endforeach
                        <a href="{{$data->nextPageUrl()}}" class="btn rounded border" style="font-size:16px; padding: 5px 15px;">&rsaquo;</a>
                        <a href="?page={{$data->lastPage()}}" class="btn rounded border" style="font-size:16px; padding: 5px 15px;">&raquo;</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card border-0">
                <div class="border-bottom py-2 px-3 d-flex justify-content-between align-items-center">
                    <div class="fs-6 fw-bold">
                    Biểu đồ thu chi
                    </div>
                    <span class="fw-light text-primary" style="font-size: 10px">
                        {{\Carbon\Carbon::now()->format('d/m/Y')}}
                    </span>
                </div>
                <div class="m-3">
                    <span class="fw-light text-primary">&#x26AC;</span>
                    Tổng thu: {{ number_format($chart->sum(fn($q) => $q->total), 0) }}</div>
                <canvas id="myChart" class="mb-3"></canvas>
            </div>

            <div class="card border-0 mt-5">
                <div class="border-bottom py-2 px-3 d-flex justify-content-between align-items-center">
                    <div class="fs-6 fw-bold">
                    Biểu đồ khoản thu
                    </div>
                </div>
                <canvas id="yourChart" class="mb-3"></canvas>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js@3.9.1/dist/chart.min.js"></script>
<script>
const chart = {!! $chart !!}
const labels = chart.sort((a, b) => new Date(a.date) - new Date(b.date))

const getDateOfWeek = (w) => {
    const date = new Date(w);
    return date.getDate() + "/" + (date.getMonth() + 1);
}

const data = {
    labels: labels.map((label) => getDateOfWeek(label.date)),
    datasets: [{
        backgroundColor: 'rgba(16, 156, 241, 0.2)',
        borderColor: '#109CF1',
        data: labels.map(label => label.total),
        fill: 'start'
    }]
};

const config = {
    type: 'line',
    data: data,
    options: {
        elements: {
            line: {
                tension: 0.4
            }
        },
        plugins: {
            legend: {
                display: false
            }
        },
        scales: {
            x: {
                min: 0,
                max: 31,
                ticks: {
                    stepSize: 2
                }
            },
            y: {
                min: 0,
            }
        }
    }
};
const myChart = new Chart(
    document.getElementById('myChart'),
    config
);
</script>
@endsection
