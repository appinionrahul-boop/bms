<?php

namespace App\Http\Controllers;

use App\incomeCategory;
use Illuminate\Http\Request;
use App\category_sector_source;
use App\category_sector;

class IncomeCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $incomeCategory = category_sector::all();
        return view('income.addNewIncomeCategory', compact('incomeCategory'));
    }

    public function GetSubCat($id){
       
        $subcategories = category_sector_source::where('sector_root_id', '=', $id)->get();
      return response()->json($subcategories);


        //dd( $incomeCategory);
        //echo json_encode(DB::table('category_sector_source')->where('sector_root_id', $id)->get());
    }

    public function create(Request $request)
    {
        
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        incomeCategory::create([
            'sector_source_id' => $request->root_cat,
            'sub_sector_id' => $request->sub_cat,
            'sector' => $request->sector,

        ]);
           
        // Sessions Message
       $request->session()->flash('msg','Category has been added');
       //Alert::success('Success Title', 'Success Message');
        // Redirect

        return redirect('/income-category');
    }

    public function show(incomeCategory $incomeCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\incomeCategory  $incomeCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(incomeCategory $incomeCategory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\incomeCategory  $incomeCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, incomeCategory $incomeCategory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\incomeCategory  $incomeCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(incomeCategory $incomeCategory)
    {
        //
    }

    public function createSubSector()
    {
        $incomeCategory = category_sector::all();
        return view('income.addNewIncomeSubCategory', compact('incomeCategory'));
    }

    public function storeSubSector(Request $request )
    {
        category_sector_source::create([
            'sector_source' => $request->sector,
            'sector_root_id' => $request->root_cat,
        ]);
           
        // Sessions Message
       $request->session()->flash('msg','Category has been added');
       //Alert::success('Success Title', 'Success Message');
        // Redirect

        return redirect('/income-category');
    }
}
