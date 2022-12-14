<?php

namespace App\Http\Controllers;
use App\Models\categoryExpense;
use App\Models\expense;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
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
//        $lscategoryexpense = DB::table('category_expenses')->where('userId','=',Auth::User()->id)->whereNull('subCategoryiD')->get();
//        $subcategory = DB::table('category_expenses')->whereNotNull('subCategoryiD')->get();
        $lscategoryexpense = DB::table('category_expenses')->where('userId','=',Auth::User()->id)
            ->whereNull('subCategoryiD')->get();
        $subcategory = DB::table('category_expenses')->where('userId','=',Auth::User()->id)
            ->whereNotNull('subCategoryiD')->get();
//        $lsexpense = Expense::all();
        $lsexpense = expense::whereNotNull('CategoryExpenseiD')->orderBy('created_at','desc')->Paginate(3);
        return view('expense.index')->with(['lsexpense' => $lsexpense, 'lscategoryexpense' => $lscategoryexpense,'subcategory'=>$subcategory]);

    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $lscategoryexpense = DB::table('category_expenses')->where('userId','=',Auth::User()->id)->whereNull('subCategoryiD')->get();
        $subcategory = DB::table('category_expenses')->where('userId','=',Auth::User()->id)->whereNull('subCategoryiD')->get();
//        $lscategoryexpense = DB::table('category_expenses')->whereNull('subCategoryiD')->get();
//        $subcategory = DB::table('category_expenses')->whereNotNull('subCategoryiD')->get();
        return view('expense.create', compact('lscategoryexpense', 'subcategory'));
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
        $categoryid = $request->expense_category_id;
        if($categoryid==null){
            $categoryid = $request->expense_category;
        }
        $dateTime = $request->dateTime;
        $amount = $request->amount;
        $note = $request->input('note');

        $cate = new expense();
        $cate->userId = Auth::user()->id;
        $cate->dateTime = $dateTime;
        $cate->amount = $amount;
        $cate->note = $note;
        $cate->categoryExpenseId = $categoryid;
        $cate->save();

        $request->session()->flash('success', 'Expense created sucessfully');
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
     * @param $id
     * @param $request
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $lscategoryexpense = DB::table('category_expenses')->whereNull('subCategoryiD')->get();

        $subcategory = DB::table('category_expenses')->whereNotNull('subCategoryiD')->get();


        $cate = expense::find($id);
        $request->session()->flash('success', 'Update sucessfully');
        return view('expense.edit')->with(['cate' => $cate, 'lscategoryexpense' => $lscategoryexpense, 'subcategory' => $subcategory]);
//
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
        $result ='';
        $categoryid = $request->input('cateExpense');
        $dateTime = $request->input('date');
        $amount = $request->input('amount');
        $note = $request->input('note');

        $cate = expense:: find($id);
        $cate->dateTime = $dateTime;
        $cate->amount = $amount;
        $cate->note = $note;
        $cate->categoryExpenseId = $categoryid;
        $cate->save();
        $result ='Edit Succesfull';
        return $result;

//        $request->session()->flash('success', 'Expense update sucessfully');
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
        $cate = expense::find($id);
        $cate->delete();
        $request->session()->flash('success', 'Delete sucessfully');
        return redirect(route('expense.index'));
    }


    public function search(Request $request)
    {
        $title = $request->input('title');
        $dateTime = $request->input('dateTime');
        $lscategoryexpense = DB::table('category_expenses')->whereNull('subCategoryiD')->get();
        $subcategory = DB::table('category_expenses')->whereNotNull('subCategoryiD')->get();

        if (is_null($title) && (is_null($dateTime))) {
            $lsexpense = expense::query()->get();
            return view('expense.index', compact('lsexpense', 'lscategoryexpense', 'subcategory'));
        } else {
            if (!is_null($title) && (is_null($dateTime))) {
                $lsexpense = expense::query()->whereHas('categoryexpense', function ($query) use ($title) {
                    return $query
                        ->join('category_expenses as parent_categoryexpense', 'parent_categoryexpense.id', '=', 'category_expenses.subCategoryiD')
                        ->where('parent_categoryexpense.name', '=', $title);
                });

                $lsexpense = $lsexpense->get();
                return view('expense.index', compact('lsexpense', 'lscategoryexpense', 'subcategory', 'title'));
            }if (is_null($title) && (!is_null($dateTime))) {
                $lsexpense = expense::query()->whereHas('categoryexpense', function ($query) use ($dateTime) {
                    return $query
                        ->join('category_expenses as parent_categoryexpense', 'parent_categoryexpense.id', '=', 'category_expenses.subCategoryiD')
                        ->where('parent_categoryexpense.dateTime', '=', $dateTime);
                });
                $lsexpense = $lsexpense->get();
                return view('expense.index', compact('lsexpense', 'lscategoryexpense', 'subcategory', 'title'));


            } else {
                $lsexpense = expense::query()->whereHas('dateTime', $dateTime)
                    ->where('title', $title);
                return view('expense.index', compact('lsexpense', 'subcategory', 'subcategory'));
            }

        }

    }

}
