<?php

namespace App\Http\Controllers;

use App\Models\expense;
use App\Models\expenseLimit;
use App\Models\income;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class dashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        //
        $monthNow = Carbon::now()->month;
        $today = Carbon::now();
        $limits = expenseLimit::where('userId','=',Auth::user()->id)->orderBy('startDate','desc')->get();
        $currentLimit=0;
        $currentLimit = expenseLimit::where('userId','=',Auth::user()->id)
            ->where('startDate','<=',$today)
            ->where('endDate','>',$today)
            ->select('limit')
            ->get();
        if($currentLimit == null){
            $currentLimit=0;
        }

        foreach ($limits as $limit){
            if(today()>$limit->startDate && today()<=$limit->endDate){
                $currentLimit = $limit->limit;
            }
        }
        $limits = expenseLimit::where('userId','=',Auth::user()->id)->orderBy('startDate','desc')->Paginate(5);

        $sumIncome = income::where('userId','=',Auth::user()->id)
            ->whereMonth('dateTime',$monthNow)
            ->sum('amount');
        $incomes = income::where('userId','=',Auth::user()->id)
            ->whereMonth('dateTime',$monthNow)
            ->orderBy('dateTime','desc')
            ->Paginate(5,['*'],'incomes')
//        ->get()
        ;

        $sumExpense = expense::where('userId','=',Auth::user()->id)
            ->whereMonth('dateTime',$monthNow)
            ->sum('amount');
        $expenses = expense::where('userId','=',Auth::user()->id)
            ->whereMonth('dateTime',$monthNow)
            ->orderBy('dateTime','desc')
            ->Paginate(5,['*'],'expenses')
//        ->get()
        ;

        if($sumExpense!=null){
            if($sumExpense > $currentLimit){
                $warning = 'Chi tiêu đang vượt '.number_format($sumExpense-$currentLimit).' VND';
            }else{
                $warning ='';
            }
        }else{
            $warning ='';
        }

//dd($currentLimit->count());

        return view('dashboard.index',compact('warning','currentLimit','limits','incomes','expenses','sumIncome','sumExpense'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
