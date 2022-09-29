<?php

namespace App\Http\Controllers;

use App\Models\categoryIncome;
use Illuminate\Http\Request;
use App\Models;
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
        $lsCategoryIncome = Models\categoryIncome::all();
        $laCategoryIncome = categoryIncome::whereNotNull('subCategoryiD')->orderBy('created_at','desc')->Paginate(5);
        return view('CategoryIncome.index')->with('lsCategoryIncome',$lsCategoryIncome);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('CategoryIncome.create');
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
                'name' => 'required|min:0|max:500'
            ]);
        $subCategoryiD = $request->input('subCategoryiD');
        $name = $request->input('name');

        $ctincome = new Models\CategoryIncome();
        $ctincome->name =$name;
        $ctincome->subCategoryiD=$subCategoryiD;
        $ctincome->save();

        $request->session()->flash('success', 'New Income category created successfully');

        return redirect(route('CategoryIncome.index'));
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
        $ctincome = Models\CategoryIncome::find($id);
        return view('CategoryIncome.edit')->with('ctincome', $ctincome);
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
                'name' => 'required|min:0|max:500'
            ]);
        $subCategoryiD = $request->input('subCategoryiD');
        $name = $request->input('name');

        $ctincome = Models\CategoryIncome::find($id);
        $ctincome->name =$name;
        $ctincome->subCategoryiD=$subCategoryiD;
        $ctincome->save();


        $request->session()->flash('success', 'Category Income updated sucessfully.');
        return redirect(route('CategoryIncome.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\categoryIncome  $categoryIncome
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        $ctincome = Models\categoryIncome::find($id);
        if($ctincome == null) {
            $request->session()->flash('danger', 'Category Income not found.');
        } else {
            $ctincome->delete();
            $request->session()->flash('success', 'Category Income deleted successfully.');
        }
        return redirect(route('CategoryIncome.index'));
    }
}
