<?php

namespace App\Http\Controllers;

use App\Models\categoryIncome;
use App\Models\income;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class IncomeController extends Controller
{
    protected categoryIncome $categoryincome;

    public function __construct(categoryIncome $categoryincome)
    {
        $this->categoryincome = $categoryincome;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $lscategoryincome = DB::table('category_incomes')->where('userId','=',Auth::User()->id)->whereNull('subCategoryiD')->get();
        $subcategory = DB::table('category_incomes')->whereNotNull('subCategoryiD')->get();
//        $lsincome = income::all();
        $lsincome = income::whereNotNull('CategoryIncomeiD')->orderBy('created_at','desc')->Paginate(3);
        return view('income.index')->with(['lsincome' => $lsincome, 'lscategoryincome' => $lscategoryincome,'subcategory'=>$subcategory]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $lscategoryincome = DB::table('category_incomes')->whereNull('subCategoryiD')->get();
        $subcategory = DB::table('category_incomes')->whereNotNull('subCategoryiD')->get();
        return view('income.create', compact('lscategoryincome', 'subcategory'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//        $this->validate($request,[
//            'name'=> 'required |min:5|max:500'
//        ]);
        $categoryid = $request->income_category_id;
        if($categoryid==null){
            $categoryid = $request->income_category;
        }
        $dateTime = $request->dateTime;
        $amount = $request->amount;
        $note = $request->input('note');
        $cate = new income();
        $cate->dateTime = $dateTime;
        $cate->amount = $amount;
        $cate->note = $note;
        $cate->categoryIncomeId = $categoryid;
        $cate->save();

        $request->session()->flash('success', 'Income created sucessfully');
        return redirect(route('income.index'));




    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\income $income
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\income $income
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
//        $this->validate($request,[
//            'name'=> 'required |min:5|max:500'
//        ]);
        $lscategoryincome = DB::table('category_incomes')->whereNull('subCategoryiD')->get();

        $subcategory = DB::table('category_incomes')->whereNotNull('subCategoryiD')->get();


        $cate = income::find($id);
        $request->session()->flash('success', 'Update sucessfully');

        return view('income.edit')->with(['cate' => $cate, 'lscategoryincome' => $lscategoryincome, 'subcategory' => $subcategory]);
    }



    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\income $income
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
//        $this->validate($request,[
//            'name'=> 'required |min:5|max:500'
//        ]);


        $result='';
//        $categoryid = $request->income_category_id;
        $categoryid = $request->input('cateIncome');

//        $dateTime = $request->dateTime;
        $dateTime = $request->input('date');

//        $amount = $request->amount;
        $amount = $request->input('amount');

        $note = $request->input('note');

        $cate = income::find($id);
        $cate->dateTime = $dateTime;
        $cate->amount = $amount;
        $cate->note = $note;
        $cate->categoryIncomeId = $categoryid;
        $cate->save();
        $result ='sua thanh cong';
        return $result;
//
//        $request->session()->flash('success', 'Income created sucessfully');




//        return redirect(route('income.index'));

//           return view('income.create', compact('lscategoryincome', 'subcategory'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\income $income
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $cate = income::find($id);
        $cate->delete();
        $request->session()->flash('success', 'Delete sucessfully');
        return redirect(route('income.index'));
    }


    public function search(Request $request)
    {
        $title = $request->input('title');
        $dateTime = $request->input('dateTime');
        $lscategoryincome = DB::table('category_incomes')->whereNull('subCategoryiD')->get();
        $subcategory = DB::table('category_incomes')->whereNotNull('subCategoryiD')->get();

        if (is_null($title) && (is_null($dateTime))) {
            $lsincome = income::query()->get();
            return view('income.index', compact('lsincome', 'lscategoryincome', 'subcategory'));
        } else {
            if (!is_null($title) && (is_null($dateTime))) {
                $lsincome = income::query()->whereHas('categoryincome', function ($query) use ($title) {
                    return $query
                        ->join('category_incomes as parent_categoryincome', 'parent_categoryincome.id', '=', 'category_incomes.subCategoryiD')
                        ->where('parent_categoryincome.name', '=', $title);
                });

                $lsincome = $lsincome->get();
                return view('income.index', compact('lsincome', 'lscategoryincome', 'subcategory', 'title'));
            }if (is_null($title) && (!is_null($dateTime))) {
                $lsincome = income::query()->whereHas('categoryincome', function ($query) use ($dateTime) {
                    return $query
                        ->join('category_incomes as parent_categoryincome', 'parent_categoryincome.id', '=', 'category_incomes.subCategoryiD')
                        ->where('parent_categoryincome.dateTime', '=', $dateTime);
                });
                $lsincome = $lsincome->get();
                return view('income.index', compact('lsincome', 'lscategoryincome', 'subcategory', 'title'));

//                $lsincome = income::query()->whereHas('dateTime', $dateTime);
//                return view('income.index', compact('lsincome', 'subcategory', 'subcategory'))
//                    ->where('parent_categoryincome.dateTime', '=', $dateTime);;
            } else {
                $lsincome = income::query()->whereHas('dateTime', $dateTime)
                    ->where('title', $title);
                return view('income.index', compact('lsincome', 'subcategory', 'subcategory'));
            }

        }

    }
}
