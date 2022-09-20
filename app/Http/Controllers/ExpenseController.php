<?php

namespace App\Http\Controllers;
use App\Models\categoryExpense;
use App\Models\Expense;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ExpenseController extends Controller
{
    protected categoryExpense $categoryexpense;
    public function __construct(categoryExpense $categoryexpense)
    {
        $this->categoryexpense = $categoryexpense;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lscategoryexpense = DB::table('category_expenses')->whereNull('subCategoryiD')->get();
        $lsexpense = Expense::all();
        return view('expense.index')->with(['lsexpense' => $lsexpense, 'lscategoryexpense' => $lscategoryexpense]);
//        $lsExpense = Models\Expense::all();
//        return view('expense.index')->with('lsExpense', $lsExpense);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $lscategoryexpense = DB::table('category_expenses')->whereNull('subCategoryiD')->get();
        $subcategory = DB::table('category_expenses')->whereNotNull('subCategoryiD')->get();
        return view('expense.create', compact('lscategoryexpense', 'subcategory'));
//        return view('expense.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $categoryid = $request->expense_category_id;
        if($categoryid==null){
            $categoryid = $request->expense_category;
        }
        $dateTime = $request->dateTime;
        $amount = $request->amount;
        $note = $request->input('note');

        $cate = new Expense();
        $cate->dateTime = $dateTime;
        $cate->amount = $amount;
        $cate->note = $note;
        $cate->categoryExpenseId = $categoryid;
        $cate->save();

        $request->session()->flash('success', 'Expense created sucessfully');
        return redirect(route('expense.index'));
//        $this->validate($request,
//            [
//                'amount' => 'required|min:1|max:50'
//            ]);
//        $dateTime = $request->dateTime;
//        $categoryExpenseId = $request->categoryExpenseId;
//        $amount = $request->amount;
////        $type = $request->type;
////        $components = $request->components;
//        $note = $request->input('note');
//
//
//        $expense = new Expense();
//        $expense->amount = $amount;
//        $expense->categoryExpenseId = $categoryExpenseId;
////        $expense->type = $type;
////        $expense->components = $components;
//        $expense->note = $note;
//        $expense->dateTime = $dateTime;
//        $expense->save();
//
//        $request->session()->flash('success', 'Expense created sucessfully.');
//        return redirect(route('expense.index'));
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
     * @param $id
     * @param $request
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $lscategoryexpense = DB::table('category_expenses')->whereNull('subCategoryiD')->get();

        $subcategory = DB::table('category_expenses')->whereNotNull('subCategoryiD')->get();


        $cate = Expense::find($id);
        $request->session()->flash('success', 'Update sucessfully');
        return view('expense.edit')->with(['cate' => $cate, 'lscategoryexpense' => $lscategoryexpense, 'subcategory' => $subcategory]);
//        $expense = Models\Expense::find($id);
//        return view('expense.edit')->with('expense', $expense);
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
        $categoryid = $request->expense_category_id;
        $dateTime = $request->dateTime;
        $amount = $request->amount;
        $note = $request->input('note');

        $cate = Expense:: Find($id);
        $cate->dateTime = $dateTime;
        $cate->amount = $amount;
        $cate->note = $note;
        $cate->categoryid = $categoryid;
        $cate->save();


        $request->session()->flash('success', 'Expense update sucessfully');
        return redirect(route('expense.index'));
//        $this->validate($request,
//            [
//                'amount' => 'required|min:1|max:50'
//            ]);
//
//        $amount = $request->amount;
////        $type = $request->type;
//        $note = $request->input('note');
//
//        $expense = Models\Expense::find($id);
//        $expense->amount = $amount;
////        $expense->type = $type;
//        $expense->note = $note;
//        $expense->save();
//
//        $request->session()->flash('success', 'Expense update sucessfully.');
//        return redirect(route('expense.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $cate = Expense::find($id);
        $cate->delete();
        $request->session()->flash('success', 'Delete sucessfully');
        return redirect(route('expense.index'));
    }
//    public function destroy($id, Request $request)
//    {
//        $expense = Models\Expense::find($id);
//        if($expense == null) {
//            $request->session()->flash('danger', 'Expense not found.');
//        } else {
//            $expense->delete();
//            $request->session()->flash('success', 'Expense deleted sucessfully.');
//        }
//        return redirect(route('expense.index'));
//    }
    public function search(Request $request)
    {
        $title = $request->input('title');
        $dateTime = $request->input('dateTime');
        $lscategoryexpense = DB::table('category_expenses')->whereNull('subCategoryiD')->get();
        $subcategory = DB::table('category_expenses')->whereNotNull('subCategoryiD')->get();

        if (is_null($title) && (is_null($dateTime))) {
            $lsexpense = Expense::query()->get();
            return view('expense.index', compact('lsexpense', 'lscategoryexpense', 'subcategory'));
        } else {
            if (!is_null($title) && (is_null($dateTime))) {
                $lsexpense = Expense::query()->whereHas('categoryexpense', function ($query) use ($title) {
                    return $query
                        ->join('category_expenses as parent_categoryexpense', 'parent_categoryexpense.id', '=', 'category_expenses.subCategoryiD')
                        ->where('parent_categoryexpense.name', '=', $title);
                });

                $lsexpense = $lsexpense->get();
                return view('expense.index', compact('lsexpense', 'lscategoryexpense', 'subcategory', 'title'));
            } elseif (is_null($title) && (!is_null($dateTime))) {
                $lsexpense = Expense::all()->where('dateTime', $dateTime);
                return view('expense.index', compact('lsexpense', 'subcategory', 'subcategory'));
            } else {
                $lsexpense = Expense::all()->where('dateTime', $dateTime)
                    ->where('title', $title);
                return view('expense.index', compact('lsexpense', 'subcategory', 'subcategory'));
            }

        }

    }

}
