<?php

namespace App\Http\Controllers;

use App\Models\categoryIncome;
use Illuminate\Http\Request;
use App\Models;
use Illuminate\Support\Facades\Auth;


class CategoryIncomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $lsCategoryIncome = Models\categoryIncome::all()->where('userId','=',Auth::User()->id);
        $lscategory= categoryIncome::whereNotNull('subCategoryiD')->orderBy('created_at','desc')->Paginate(5);
        return view('CategoryIncome.index')->with(['lsCategoryIncome'=>$lsCategoryIncome,'lscategory'=>$lscategory]);
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
        $ctincome->userId = Auth::user()->id;
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
    public function edit($id,Request $request)
    {
        $ctincome = Models\CategoryIncome::find($id);
        $request->session()->flash('success', 'Update successfully');
        return view('CategoryIncome.edit', compact('ctincome'))->with('ctincome', $ctincome);
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

        $ctincome = categoryIncome::find($id);
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

    public function getIncomeTest($id) {
        return Models\categoryIncome::where('id', $id)->get();
    }
}
