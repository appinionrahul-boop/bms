<?php

namespace App\Http\Controllers;

use App\income;
use App\incomeCategory;
use App\category_sector_source;
use App\category_sector;
use App\Support\FiscalYear;
use Illuminate\Http\Request;

class IncomeController extends Controller
{
    
    public function index()
    {
        $incomeCategory = category_sector::all();
        return view ('income.addNewIncome' , compact('incomeCategory'));
    }

    
    public function getSubCat($id)
    {
        $subcategories = category_sector_source::where('sector_root_id', $id)->get();
    
        return response()->json($subcategories);
    }
    
    // ===============================
    // GET BOTTOM SUB CATEGORY (AJAX)
    // ===============================
    public function getBotSubCat($id)
    {
        $subBotCategories = incomeCategory::where('sub_sector_id', $id)->get();
    
        return response()->json($subBotCategories);
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
        $bsc;
        if ($request->botSubCat=='') {
            $bSC='0';
        }
        else{
            $bSC= $request->botSubCat;
        }

         
        $date = strtotime($request->income_date);
        $dateF = date('y/m/d', $date);

        // return $dateF;
        income::create([
            'voucher_no' => $request->income_voucher,
            'income_cheque' => $request->income_cheque,
            'fiscal_year' => $request->income_fiscalYear,
            'income_source' => $request->root_cat,
            'income_sub_source' => $request->sub_cat,
            'income_bot_source' =>$bSC,
            'income_date' =>  $dateF,
            'income_amount' => $request->income_amount,
            'income_descriptation' => $request->income_message,
            'income_pred' => $request->income_pred,
            'submit_by' => auth()->user()->id,
        ]);

        
        $request->session()->flash('msg','Category has been added');
        return redirect('/income');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\income  $income
     * @return \Illuminate\Http\Response
     */
    public function deleteUser()
    {       dd("dsds");
          return redirect('/income');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\income  $income
     * @return \Illuminate\Http\Response
     */
    public function edit(income $income)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\income  $income
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, income $income)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\income  $income
     * @return \Illuminate\Http\Response
     */
    public function destroy(income $income)
    {
        //
    }
    public function incomeCategory()
    {
        $incomeCat = incomeCategory::with('getIncomeCat')->get();

        $incomeSubCat = incomeCategory::with('getSubIncomeCat')->get();
        //return $incomeCat;
        return view('income.incomeCategory',  compact('incomeCat', 'incomeSubCat'));
    }

    public function incomeHome(Request $request)
    {
        $fy = FiscalYear::active();

        $query = income::with(['getIncomeCat', 'getSubIncomeCat', 'getBotSubIncomeCat'])
            ->where('fiscal_year', $fy)
            ->where('income_pred', '0');

        if ($request->search) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('voucher_no', 'LIKE', "%$search%")
                    ->orWhere('income_cheque', 'LIKE', "%$search%")
                    ->orWhere('income_date', 'LIKE', "%$search%")
                    ->orWhere('income_amount', 'LIKE', "%$search%")
                    ->orWhere('income_descriptation', 'LIKE', "%$search%")
                    ->orWhere('fiscal_year', 'LIKE', "%$search%")
                    ->orWhereHas('getIncomeCat', function ($q2) use ($search) {
                        $q2->where('category_sector', 'LIKE', "%$search%");
                    })
                    ->orWhereHas('getSubIncomeCat', function ($q3) use ($search) {
                        $q3->where('sector_source', 'LIKE', "%$search%");
                    })
                    ->orWhereHas('getBotSubIncomeCat', function ($q4) use ($search) {
                        $q4->where('sector', 'LIKE', "%$search%");
                    });
            });
        }

        $income = $query
            ->orderBy('id', 'desc')
            ->paginate(10)
            ->appends($request->all());

        return view('income.incomeHome', compact('income'));
    }

    public function editIncome($id)
    {
        $income = income::findOrFail($id);
        $incomeCategory = category_sector::all();
        $subCategories = $income->income_source
            ? category_sector_source::where('sector_root_id', $income->income_source)->get()
            : collect();
        $botSubCategories = $income->income_sub_source
            ? incomeCategory::where('sub_sector_id', $income->income_sub_source)->get()
            : collect();

        return view('income.editIncome', compact('income', 'incomeCategory', 'subCategories', 'botSubCategories'));
    }

    public function updateIncome(Request $request,$id)
    {
        $incomeUpdate = income::findOrFail($id);

        if ($request->botSubCat == '') {
            $bSC = '0';
        } else {
            $bSC = $request->botSubCat;
        }

        $date = strtotime($request->income_date);
        $dateF = date('y/m/d', $date);

            $incomeUpdate->update([

            'voucher_no' => $request->income_voucher,
            'income_cheque' => $request->income_cheque,
            'fiscal_year' => $request->income_fiscalYear,
            'income_source' => $request->root_cat,
            'income_sub_source' => $request->sub_cat,
            'income_bot_source' => $bSC,
            'income_date' =>  $dateF,
            'income_amount' => $request->income_amount,
            'income_descriptation' => $request->income_message,
            'income_pred' => $request->income_pred,
            'submit_by' => auth()->user()->id,
            ]);
            return redirect('/income');
    }

    public function deleteIncome($id)
    {
        income::destroy($id);
        return redirect('/income');
    }
}
