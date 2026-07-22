<?php

namespace App\Http\Controllers;
use App\Expense;
use App\ExpenseCategory;
use App\ExpenseSubCategory;
use App;
use PDF;

use Illuminate\Http\Request;

class ExpenseReportController extends Controller
{
    public function abstractDateSelect()
    {
        return view('report.expenseAbstract');
    }
    public function expenseAbstract(Request $request)
    {
    
        $date1 = strtotime( $request->income_start_date);
        $date2 = strtotime( $request->income_end_date);
        // $date2 = date('d/m/y', $date);

        $startDate = date('y/m/d', $date1);
        $endDate = date('y/m/d', $date2);
        // $config = [
        //     'format' => 'A4-L' // Landscape
        // ];
        $fy='২০২৫-২০২৬';
        $expenseCat = Expense::with('getExpenseCategory')->get();
        $expenseSubCat = Expense::with('getExpenseSubCategory')->get();
        $expense = Expense::whereBetween('expense_date', [$startDate, $endDate])->where('fiscal_year',$fy)
        ->where('expense_category','1')->where('expense_pred','0')->orwhereBetween('expense_date', [$startDate, $endDate])->where('expense_category','4')->where('expense_pred','0')->orwhereBetween('expense_date', [$startDate, $endDate])->where('expense_category','5')->where('expense_pred','0')
        ->orderBy('expense_date', 'ASC')->get();
         //return $expense;

        view()->share('expense',$expense,$expenseCat,$expenseSubCat );
            
            $pdf = PDF::loadView('reportDownload.expenseAbDownload',$expense);
            return $pdf->stream('document.pdf');
                    
        
        //return view('reportView.incomeAbView', compact('incomeCat', 'incomeSubCat', 'incomeBotSubCat', 'income'));
    }

    public function abstractDateSelectGov()
    {
        return view('report.expenseAbstractGov');
    }

    public function expenseAbstractGov(Request $request)
    {
        $date1 = strtotime( $request->income_start_date);
        $date2 = strtotime( $request->income_end_date);
        // $date2 = date('d/m/y', $date);

        $startDate = date('y/m/d', $date1);
        $endDate = date('y/m/d', $date2);
        // $config = [
        //     'format' => 'A4-L' // Landscape
        // ];
        $fy='২০২৫-২০২৬';
        $expenseCat = Expense::with('getExpenseCategory')->get();
        $expenseSubCat = Expense::with('getExpenseSubCategory')->get();
        $expense = Expense::whereBetween('expense_date', [$startDate, $endDate])->where('fiscal_year',$fy)->whereBetween('expense_date', [$startDate, $endDate])->where('expense_category','3')->where('expense_pred','0')
        ->orderBy('expense_date', 'ASC')->get();
         //return $expense;

        view()->share('expense',$expense,$expenseCat,$expenseSubCat );
            
            $pdf = PDF::loadView('reportDownload.expenseAbDownloadGov',$expense);
            return $pdf->stream('document.pdf');
                    
        
        //return view('reportView.incomeAbView', compact('incomeCat', 'incomeSubCat', 'incomeBotSubCat', 'income'));
    }

    public function viewBillRegistar()
    {
        return view('report.expenseBillRegistar');
    }

    public function expenseBillRegistar(Request $request)
    {
        ini_set("pcre.backtrack_limit", "50000000");
        $date1 = strtotime( $request->income_start_date);
        $date2 = strtotime( $request->income_end_date);
        // $date2 = date('d/m/y', $date);

        $startDate = date('y/m/d', $date1);
        $endDate = date('y/m/d', $date2);
        $config = [
            'format' => 'A4-L' // Landscape
        ];
     
        $expenseCat = Expense::with('getExpenseCategory')->get();
        $expenseSubCat = Expense::with('getExpenseSubCategory')->get();
        $expense = Expense::whereBetween('expense_date', [$startDate, $endDate])->where('expense_category','1')->where('expense_pred','0')->orWhereBetween('expense_date', [$startDate, $endDate])->
         Where('expense_category','4')->orWhereBetween('expense_date', [$startDate, $endDate])->
         Where('expense_category','5')->where('expense_pred','0')->orderBy('voucher_no', 'ASC')->get();
        
        view()->share('expense',$expense,$expenseCat,$expenseSubCat );
            
            $pdf = PDF::loadView('reportDownload.expenseBillRegistarDownload',$expense,[ ], $config);
            return $pdf->stream('document.pdf');
    }

    public function viewBillRegistarGov()
    {
        return view('report.expenseBillRegistarGov');
    }

    public function expenseBillRegistarGov(Request $request)
    {
        ini_set("pcre.backtrack_limit", "5000000");
        $date1 = strtotime( $request->income_start_date);
        $date2 = strtotime( $request->income_end_date);
        // $date2 = date('d/m/y', $date);

        $startDate = date('y/m/d', $date1);
        $endDate = date('y/m/d', $date2);
        $config = [
            'format' => 'A4-L' // Landscape
        ];
     
        $expenseCat = Expense::with('getExpenseCategory')->get();
        $expenseSubCat = Expense::with('getExpenseSubCategory')->get();
        $expense = Expense::whereBetween('expense_date', [$startDate, $endDate])->where('expense_category','3')->where('expense_pred','0')->orderBy('expense_date', 'ASC')->get();

        view()->share('expense',$expense,$expenseCat,$expenseSubCat );
            
            $pdf = PDF::loadView('reportDownload.expenseBillRegistarDownloadGov',$expense,[ ], $config);
            return $pdf->stream('document.pdf');
    }
}
