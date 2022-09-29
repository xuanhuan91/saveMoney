<?php

namespace App\Http\Controllers;

use App\Models\expense;
use App\Models\expenseLimit;
use App\Models\income;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class dashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $limits = expenseLimit::where('userId','=',Auth::user()->id)->orderBy('startDate','desc')->get();
        $currentLimit=0;
        foreach ($limits as $limit){
            if(today()>$limit->startDate && today()<=$limit->endDate){
                $currentLimit = $limit->limit;
            }
        }
        $limits = expenseLimit::where('userId','=',Auth::user()->id)->orderBy('startDate','desc')->Paginate(5);

        $incomes = income::where('userId','=',Auth::user()->id)->orderBy('dateTime','desc')
//            ->Paginate(5)
        ->get()
        ;
        $expenses = expense::where('userId','=',Auth::user()->id)->orderBy('dateTime','desc')
//            ->Paginate(5)
        ->get()
        ;

        return view('dashboard.index',compact('currentLimit','limits','incomes','expenses'));
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
