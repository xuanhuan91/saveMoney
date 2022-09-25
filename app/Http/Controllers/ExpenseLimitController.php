<?php

namespace App\Http\Controllers;

use App\Models\expenseLimit;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExpenseLimitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
//        $limits = expenseLimit::where('userId','=',Auth::user()->id);
        $startDate = $request->input('startDate');
        $endDate = $request->input('endDate');

        $limit = new expenseLimit();

        $limit->userId = Auth::user()->id;
        $limit->limit = $request->input('limit');
        $limit->startDate = $request->input('startDate');
        $limit->endDate = $request->input('endDate');
        $limit->note = $request->input('note');
        $limit->save();
        $limits = expenseLimit::where('userId','=',Auth::user()->id)->orderBy('startDate','desc')->get();
        $currentLimit=0;
        foreach ($limits as $limit){
            if(today()>$limit->startDate && today()<=$limit->endDate){
                $currentLimit = $limit->limit;
            }
        }
        return view('dashboard.index',compact('currentLimit','limits'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\expenseLimit  $expenseLimit
     * @return \Illuminate\Http\Response
     */
    public function show(expenseLimit $expenseLimit)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\expenseLimit  $expenseLimit
     * @return \Illuminate\Http\Response
     */
    public function edit(expenseLimit $expenseLimit)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\expenseLimit  $expenseLimit
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, expenseLimit $expenseLimit)
    {
        //
        $id = $request->input('id');
        $expenseLimit = expenseLimit::find($id);
        $startDate = $request->input('startDate');
        $endDate = $request->input('endDate');
        $limit = $request->input('limit');
        $note = $request->input('note');
        $expenseLimit->startDate=$startDate;
        $expenseLimit->endDate=$endDate;
        $expenseLimit->limit=$limit;
        $expenseLimit->note=$note;
        $expenseLimit->save();
        return 'Sửa thông tin hạn mức thành công';


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\expenseLimit  $expenseLimit
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        //
        $id = $request->input('id');
        $expenseLimit = expenseLimit::find($id);
        $expenseLimit->delete();
        return 'Xóa hạn mức thành công';

    }

    public function checkStartDate(request $request){
        $limits = expenseLimit::where('userId','=',Auth::user()->id)->get();
        $startDate=$request->input('startDate');
        foreach ($limits as $limit){
            if($startDate < $limit->endDate)
            {
                $result='Ngày bắt đầu phải sau ngày '.$limit->endDate.' (yyy-mm-dd)';
                break;
            }
        }
        return $result;

    }
}
