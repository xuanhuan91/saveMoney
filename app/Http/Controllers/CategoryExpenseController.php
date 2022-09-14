<?php

namespace App\Http\Controllers;

use App\Models\categoryExpense;
use Illuminate\Http\Request;
use Carbon\Carbon;

class CategoryExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $parentCategoryExpense = \App\Models\categoryExpense::where('parent_id', 0)->get();
        return view('categoryExpense.index', compact('parentCategoryExpense'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
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
        $name = $request->input('name');

        $cate = new Models\categoryExpense();
        $cate->name =$name;
        $cate->save();

        $request->session()->flash('success', 'New Expense category created successfully');

        return redirect(route('category.index'));
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
    public function edit($id)
    {
        $parentCategory = \App\Models\categoryExpense::find($id);
        return view('categoryExpense.edit')->with('cate', $parentCategory);
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
        $name = $request->name;

        $parentCategory = \App\Models\categoryExpense::find($id);
        $parentCategory->name = $name;
        $parentCategory->save();

        $request->session()->flash('success', 'Category Expense updated sucessfully.');
        return redirect(route('categoryExpense.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\categoryExpense  $categoryExpense
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        $parentCategory = \App\Models\categoryExpense::find($id);
        if($parentCategory == null) {
            $request->session()->flash('danger', 'Category Expense not found.');
        } else {
            $parentCategory->delete();
            $request->session()->flash('success', 'Category Expense deleted sucessfully.');
        }
        return redirect(route('categoryExpense.index'));
    }
}
