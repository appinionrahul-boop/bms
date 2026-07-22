<?php

namespace App\Http\Controllers;

use App\Expense;
use App\ExpenseCategory;
use App\ExpenseSubCategory;
use App\Support\FiscalYear;
use Illuminate\Http\Request;
use DB;
use PDF;

class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function index()
    // {
    //     //$fy='২০২০-২০২১';
    //      $fy1='২০২৫-২০২৬';
    //     $expenseCat = Expense::with('getExpenseCategory')->get();
    //     $expenseSubCat = Expense::with('getExpenseSubCategory')->get();
    //     $expense = Expense::where('fiscal_year', '=', $fy1)->where('expense_pred','=','0')
    //     ->get();

    //   return view('expense.expenseHome',  compact('expenseCat', 'expenseSubCat', 'expense'));

    // }
  public function index(Request $request)
{
    $fy = FiscalYear::active();

    $query = Expense::with(['getExpenseCategory', 'getExpenseSubCategory'])
        ->where('fiscal_year', $fy)
        ->where('expense_pred', '0');

    // Search
    if ($request->search) {
        $search = $request->search;

        $query->where(function ($q) use ($search) {
            $q->where('voucher_no', 'LIKE', "%$search%")
              ->orWhere('expense_cheque', 'LIKE', "%$search%")
              ->orWhere('expense_date', 'LIKE', "%$search%")
              ->orWhere('descriptation', 'LIKE', "%$search%")
              ->orWhere('fiscal_year', 'LIKE', "%$search%")
              ->orWhere('totalExpense', 'LIKE', "%$search%")
              ->orWhereHas('getExpenseCategory', function ($q2) use ($search) {
                  $q2->where('expense_category', 'LIKE', "%$search%");
              })
              ->orWhereHas('getExpenseSubCategory', function ($q3) use ($search) {
                  $q3->where('expense_subCategory', 'LIKE', "%$search%");
              });
        });
    }

    $expense = $query
        ->orderBy('id', 'desc')
        ->paginate(10)
        ->appends($request->all());   // ✅ Works in all Laravel versions

    return view('expense.expenseHome', compact('expense'));
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
        
        $totalExpense=0;

        // if ($request->vat_amount==NULL) {
        //     $vatAmount=0;
        // }

        // if ($request->tax_amount==NULL) {
        //     $taxAmount=0;
        // }

        $date = strtotime($request->expense_date);
      $dateF = date('y/m/d', $date);

        $totalExpense=$request->vat_amount+ $request->tax_amount+$request->expense_amount;

        Expense::create([
            'fiscal_year' => $request->expense_fiscalYear,
            'expense_date' =>  $dateF,
            'expense_category' => $request->expense_cat,
            'expense_sub_category' => $request->expense_subCat,
            'expense_amount' => $request->expense_amount,
            'voucher_no' => $request->expense_voucher,
            'expense_cheque' => $request->expense_cheque,
            'expense_vat' => $request->expense_vat,
            'expense_folio' => $request->expense_folio,
            'descriptation' => $request->expense_message,
            'vat_cheque_descriptation' => $request->vat_cheque_descriptation,
            'vat_amount' => $request->vat_amount,
            'expense_tax' => $request->expense_tax,
            'tax_cheque_descriptation' => $request->tax_cheque_descriptation,
            'tax_amount' => $request->tax_amount,
            'tax_desriptation' => $request->tax_desriptation,
            'expense_pred' => $request->expense_pred,
            'totalExpense' => $totalExpense,
            'submit_by' => auth()->user()->id,
        ]);

        
        $request->session()->flash('msg','Category has been added');
        return redirect('/expense');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function show(Expense $expense)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function edit(Expense $expense)
    {
        return $this->editExpense($expense->id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Expense $expense)
    {
        return $this->updateExpense($request, $expense->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function destroy(Expense $expense)
    {
        //
    }

    public function addNewExpense()
    {
        $expenseCat = ExpenseCategory::all();
        return view ('expense.addNewExpense' , compact('expenseCat'));
    }

    public function getSubCat($id)
    {
        $subcategories = ExpenseSubCategory::where('expense_cateory_id', $id)->get();
        return response()->json($subcategories);
    }

    public function editExpense($id)
    {
        $expense = Expense::findOrFail($id);
        $expenseCat = ExpenseCategory::all();
        $expenseSubCat = $expense->expense_category
            ? ExpenseSubCategory::where('expense_cateory_id', $expense->expense_category)->get()
            : collect();

        return view('expense.editExpense', compact('expense', 'expenseCat', 'expenseSubCat'));
    }

    public function updateExpense(Request $request,$id)
    {
        $expenseUpdate = Expense::findOrFail($id);

        $totalExpense=0;

        $totalExpense=$request->vat_amount+ $request->tax_amount+$request->expense_amount;

        $date = strtotime($request->expense_date);
        $dateF = date('y/m/d', $date);
            $expenseUpdate->update([
                
                'fiscal_year' => $request->expense_fiscalYear,
                'expense_date' =>   $dateF,
                'expense_category' => $request->expense_cat,
                'expense_sub_category' => $request->expense_subCat,
                'expense_amount' => $request->expense_amount,
                'voucher_no' => $request->expense_voucher,
                'expense_cheque' => $request->expense_cheque,
                'expense_vat' => $request->expense_vat,
                'expense_folio' => $request->expense_folio,
                'descriptation' => $request->expense_message,
                'vat_cheque_descriptation' => $request->vat_cheque_descriptation,
                'vat_amount' => $request->vat_amount,
                'expense_tax' => $request->expense_tax,
                'tax_cheque_descriptation' => $request->tax_cheque_descriptation,
                'tax_amount' => $request->tax_amount,
                'tax_desriptation' => $request->tax_desriptation,
                'expense_pred' => $request->expense_pred,
                'totalExpense' => $totalExpense,
                'submit_by' => auth()->user()->id,
            ]);

            return redirect('/expense');
        
    }
    public function deleteExpense($id)
    {
         Expense::destroy($id);
        return redirect('/expense');
    }
    
     public function abstractReport($id)
    {
       // $fy='২০২০-২০২১';
        $config = [
            'format' => 'A4-L' // Landscape
          ];
      
       
       // $expense = Expense::all()->where('id',$id)->where('fiscal_year', '=', $fy);
        //  return $expense;
        $expense = Expense::all()->where('id',$id);
        view()->share('expense',$expense );

        $pdf = PDF::loadView('reportDownload.expenseAbDownloadGov',$expense);
        return $pdf->stream('document.pdf');
    }
    
    public function billRegisterReport($id)
    {
       // $fy='২০২০-২০২১';
         $config = [
            'format' => 'A4-L' // Landscape
          ];
      
       
        $expense = Expense::all()->where('id',$id);
        $expenseFY = Expense::where('id',$id)->pluck('fiscal_year');
        $expenseCat = Expense::where('id',$id)->pluck('expense_category');
        //  return $expenseCat;
        view()->share('expense',$expense );
        view()->share('expenseCat',$expenseCat );
        view()->share('expenseFY',$expenseFY );

        $pdf = PDF::loadView('reportDownload.expenseInBillRegister',$expense,[ ], $config);
        return $pdf->stream('document.pdf');
    }
}
