<?php

namespace App\Http\Controllers;
use App\Models;
use App\Models\Expense;
use Illuminate\Http\Request;

class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lsExpense = Models\Expense::all();
        return view('expense.index')->with('lsExpense', $lsExpense);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('expense.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,
            [
                'amount' => 'required|min:1|max:50'
            ]);
        $dateTime = $request->dateTime;
        $categoryExpenseId = $request->categoryExpenseId;
        $amount = $request->amount;
//        $type = $request->type;
//        $components = $request->components;
        $note = $request->input('note');


        $expense = new Expense();
        $expense->amount = $amount;
        $expense->categoryExpenseId = $categoryExpenseId;
//        $expense->type = $type;
//        $expense->components = $components;
        $expense->note = $note;
        $expense->dateTime = $dateTime;
        $expense->save();

        $request->session()->flash('success', 'Expense created sucessfully.');
        return redirect(route('expense.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function show(Expense $expense)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function edit( $id)
    {
        $expense = Models\Expense::find($id);
        return view('expense.edit')->with('expense', $expense);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,
            [
                'amount' => 'required|min:1|max:50'
            ]);

        $amount = $request->amount;
//        $type = $request->type;
        $note = $request->input('note');

        $expense = Models\Expense::find($id);
        $expense->amount = $amount;
//        $expense->type = $type;
        $expense->note = $note;
        $expense->save();

        $request->session()->flash('success', 'Expense update sucessfully.');
        return redirect(route('expense.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        $expense = Models\Expense::find($id);
        if($expense == null) {
            $request->session()->flash('danger', 'Expense not found.');
        } else {
            $expense->delete();
            $request->session()->flash('success', 'Expense deleted sucessfully.');
        }
        return redirect(route('expense.index'));
    }

}
