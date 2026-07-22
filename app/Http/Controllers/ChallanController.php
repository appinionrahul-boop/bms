<?php

namespace App\Http\Controllers;

use App\Support\FiscalYear;
use App\income;
use App\incomeCategory;
use App\category_sector_source;
use App\category_sector;
use App\Expense;
use App\ExpenseCategory;
use App\ExpenseSubCategory;
use Illuminate\Http\Request;
use DB;
use PDF;

class ChallanController extends Controller
{
    public function incomeView()
    {
        $incomeCat = income::with('getIncomeCat')->get();
        $incomeSubCat = income::with('getSubIncomeCat')->get();
       $incomeBotSubCat = income::with('getBotSubIncomeCat')->get();
        $income = income::all();

        //return $incomeBotSubCat;
        //return $incomeCat;
       return view('challan.incomeChallan',  compact('incomeCat', 'incomeSubCat', 'incomeBotSubCat', 'income'));
    }

    public function download($id)
    {
        echo($id);
    }

    // public function expenseView()
    // {
    //   $fy='২০২৫-২০২৬';

    
      
    //     $expenseCat = Expense::with('getExpenseCategory')->get();
    //     $expenseSubCat = Expense::with('getExpenseSubCategory')->get();
    //     $expense = Expense::all()->where('fiscal_year', '=', $fy)->where('expense_pred', '0');
    //     //return $expense;
    //   return view('challan.expenseChallan',  compact('expenseCat', 'expenseSubCat', 'expense'));
    // }
    
        public function expenseView(Request $request)
    {
        $fy = FiscalYear::active();
    
        $query = Expense::select([
                'id',
                'voucher_no',
                'expense_cheque',
                'expense_date',
                'expense_amount',
                'expense_vat',
                'expense_tax',
                'fiscal_year'
            ])
            ->where('fiscal_year', $fy)
            ->where('expense_pred', '0')
            ->where(function ($q) {
                $q->whereNotNull('expense_vat')
                  ->orWhereNotNull('expense_tax');
            });
    
        // 🔍 Search
        if ($request->search) {
            $search = $request->search;
    
            $query->where(function ($q) use ($search) {
                $q->where('voucher_no', 'LIKE', "%$search%")
                  ->orWhere('expense_cheque', 'LIKE', "%$search%")
                  ->orWhere('expense_date', 'LIKE', "%$search%")
                  ->orWhere('expense_amount', 'LIKE', "%$search%")
                  ->orWhere('expense_vat', 'LIKE', "%$search%")
                  ->orWhere('expense_tax', 'LIKE', "%$search%")
                  ->orWhere('fiscal_year', 'LIKE', "%$search%");
            });
        }
    
        $expense = $query
            ->orderBy('id', 'desc')
            ->paginate(15)
            ->appends($request->all());
    
        return view('challan.expenseChallan', compact('expense'));
    }


    public function downloadEx($id)
    {
           $fy = FiscalYear::active();

        $config = [
            'format' => 'A4-L' // Landscape
          ];
      
        $expenseCat = Expense::with('getExpenseCategory')->get();
        $expenseSubCat = Expense::with('getExpenseSubCategory')->get();
        $expense = Expense::all()->where('id',$id)->where('fiscal_year', '=', $fy);
        //  return $expense;
        view()->share('expense',$expense );

        $pdf = PDF::loadView('challan.expenseChallanReport',$expense,[ ],$config);
        return $pdf->stream('Challan.pdf');
        //echo($expense);
    }

    
}
