<?php

namespace App\Http\Controllers;

use App\Models\categoryExpense;
use Illuminate\Http\Request;
use App\Models;
use Illuminate\Support\Facades\Auth;

class CategoryExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $lsCategoryExpense = \App\Models\categoryExpense::all()->where('userId','=', Auth::user()->id);
        //$laCategoryExpense = categoryExpense::whereNotNull('subCategoryiD')->orderBy('created_at','desc')->Paginate(5);
//        return view('CategoryExpense.index')->with('lsCategoryExpense',$lsCategoryExpense);
        $lscategory = categoryExpense::whereNotNull('subCategoryiD')->orderBy('created_at','desc')->Paginate(5);
        return view('CategoryExpense.index')->with(['lsCategoryExpense'=>$lsCategoryExpense, 'lscategory'=>$lscategory]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('CategoryExpense.create');
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
                'name' => 'required|min:5|max:500'
            ]);
        $subCategoryiD = $request->input('subCategoryiD');
        $name = $request->input('name');

        $ctexpense = new \App\Models\CategoryExpense();
        $ctexpense->name = $name;
        $ctexpense->subCategoryiD = $subCategoryiD;
        $ctexpense->userId = Auth::user()->id;
        $ctexpense->save();

        $request->session()->flash('success', 'New Expense category created successfully');

        return redirect(route('CategoryExpense.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\categoryExpense  $categoryExpense
     * @return \Illuminate\Http\Response
     */
    public function show(categoryExpense $categoryExpense)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\categoryExpense  $categoryExpense
     * @return \Illuminate\Http\Response
     */
    public function edit($id,Request $request)
    {
//        $ctexpense = \App\Models\CategoryExpense::find($id);
//        return view('CategoryExpense.edit')->with('ctexpense', $ctexpense);

        $ctexpense = \App\Models\CategoryExpense::find($id);
        $request->session()->flash('success', 'Update successfully');
        return view('CategoryExpense.edit', compact('ctexpense'))->with('ctexpense', $ctexpense);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\categoryExpense  $categoryExpense
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,
            [
                'name' => 'required|min:5|max:500'
            ]);
        $subCategoryiD = $request->input('subCategoryiD');
        $name = $request->input('name');

        $ctexpense = \App\Models\CategoryExpense::find($id);
        $ctexpense->name = $name;
        $ctexpense->subCategoryiD = $subCategoryiD;
        $ctexpense->save();
//        $result = 'Sua thanh cong';

        $request->session()->flash('success', 'Category Expense updated sucessfully.');
        return redirect(route('CategoryExpense.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\categoryExpense  $categoryExpense
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        $ctexpense = \App\Models\CategoryExpense::find($id);
        if($ctexpense == null) {
            $request->session()->flash('danger', 'Category Expense not found.');
        } else {
            $ctexpense->delete();
            $request->session()->flash('success', 'Category Expense deleted sucessfully.');
        }
        return redirect(route('CategoryExpense.index'));
    }

    public function getExpenseTest($id) {
        return \App\Models\categoryExpense::where('id', $id)->get();
    }
}
