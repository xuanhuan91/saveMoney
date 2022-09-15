<?php

namespace App\Http\Controllers;

use App\Models\categoryIncome;
use Illuminate\Http\Request;
use Carbon\Carbon;

class CategoryIncomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $parentCategoryIncome = \App\Models\categoryIncome::where('parent_id', 0)->get();
        return view('categoryIncome.index', compact('parentCategoryIncome'));
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
        $this->validate($request,
            [
                'name' => 'required|min:5|max:500'
            ]);
        $name = $request->input('name');

        $cate = new Models\CategoryIncome();
        $cate->name =$name;
        $cate->save();

        $request->session()->flash('success', 'New Income category created successfully');

        return redirect(route('category.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\categoryIncome  $categoryIncome
     * @return \Illuminate\Http\Response
     */
    public function show(categoryIncome $categoryIncome)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\categoryIncome  $categoryIncome
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $parentCategory = \App\Models\categoryIncome::find($id);
        return view('categoryIncome.edit')->with('cate', $parentCategory);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\categoryIncome  $categoryIncome
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,
            [
                'name' => 'required|min:5|max:500'
            ]);
        $name = $request->name;

        $parentCategory = \App\Models\categoryIncome::find($id);
        $parentCategory->name = $name;
        $parentCategory->save();

        $request->session()->flash('success', 'Category Income updated sucessfully.');
        return redirect(route('categoryIncome.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\categoryIncome  $categoryIncome
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        $parentCategory = \App\Models\categoryIncome::find($id);
        if($parentCategory == null) {
            $request->session()->flash('danger', 'Category Income not found.');
        } else {
            $parentCategory->delete();
            $request->session()->flash('success', 'Category Income deleted successfully.');
        }
        return redirect(route('categoryExpense.index'));
    }
}
