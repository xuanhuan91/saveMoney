<?php

namespace App\Http\Controllers;

use App\Models\categoryExpense;
use Illuminate\Http\Request;

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
    public function edit(categoryExpense $categoryExpense)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\categoryExpense  $categoryExpense
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, categoryExpense $categoryExpense)
    {
        $this->validate($request,
            [
                'name' => 'required|min:5|max:500'
            ]);
        $name = $request->name;

        $cate = Models\CategoryExpense::find($id);
        $cate->name = $name;
        $cate->save();

        $request->session()->flash('success', 'Category updated sucessfully.');
        return redirect(route('category.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\categoryExpense  $categoryExpense
     * @return \Illuminate\Http\Response
     */
    public function destroy(categoryExpense $categoryExpense)
    {
        //
    }
}
