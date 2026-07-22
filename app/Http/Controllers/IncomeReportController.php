<?php

namespace App\Http\Controllers;
use PDF;
// use Mpdf\Mpdf;
use Illuminate\Http\Request;
use App\income;
use App\incomeCategory;
use App\category_sector_source;
use App\category_sector;
use App\Expense;
use App\ExpenseCategory;
use App\ExpenseSubCategory;
use App\User;

use App;


class IncomeReportController extends Controller
{
    
    public function __construct()
    {
        set_time_limit(300);
    }

    public function incomeAbstract(Request $request)
    {
        $startDate = $request->income_start_date;
        $endDate = $request->income_end_date;
        $config = [
            'format' => 'A4-L' // Landscape
        ];
     

        $incomeCat = income::with('getIncomeCat')->get();
        $incomeSubCat = income::with('getSubIncomeCat')->get();
        $incomeBotSubCat = income::with('getBotSubIncomeCat')->get();
        $income = income::whereBetween('income_date', [$startDate, $endDate])->where('income_source','1')->
        orWhereBetween('income_date', [$startDate, $endDate])-> Where('income_source','4')->orderBy('income_date', 'ASC')->get();
        // $incomeSum = income::whereBetween('income_date', [$startDate, $endDate])->where('income_source','1')->sum('income_amount');

        //return $income;

        view()->share('income',$income,$incomeCat,$incomeSubCat, $incomeBotSubCat );
            
            $pdf = PDF::loadView('reportDownload.incomeAbDownload',$income,[ ], $config);
            return $pdf->stream('document.pdf');
                    
        
       // return view('reportView.incomeAbView', compact('incomeCat', 'incomeSubCat', 'incomeBotSubCat', 'income'));
    }

    public function viewBillRegistar()
    {
        return view('report.incomeBillRegistar');
    }

    public function incomeBillRegistar(Request $request)
    {
        $date1 = strtotime( $request->income_start_date);
        $date2 = strtotime( $request->income_end_date);
        // $date2 = date('d/m/y', $date);

        $startDate = date('y/m/d', $date1);
        $endDate = date('y/m/d', $date2);
        $config = [
            'format' => 'A4-L' // Landscape
        ];
     

        $incomeCat = income::with('getIncomeCat')->get();
        $incomeSubCat = income::with('getSubIncomeCat')->get();
        $incomeBotSubCat = income::with('getBotSubIncomeCat')->get();
        $income = income::whereBetween('income_date', [$startDate, $endDate])->where('income_source','1')
        ->orWhereBetween('income_date', [$startDate, $endDate])->Where('income_source','4')->orderBy('income_date', 'ASC')->get();
        // $incomeSum = income::whereBetween('income_date', [$startDate, $endDate])->where('income_source','1')->sum('income_amount');

        //return $income;

        view()->share('income',$income,$incomeCat,$incomeSubCat, $incomeBotSubCat );
            
            $pdf = PDF::loadView('reportDownload.incomeBillRegistarDownload',$income,[ ], $config);
            return $pdf->stream('document.pdf');
                    
        
        //return view('reportView.incomeAbView', compact('incomeCat', 'incomeSubCat', 'incomeBotSubCat', 'income'));
    }


    public function viewBillRegistarGov()
    {
        return view('report.incomeBillRegistarGov');
    }

    public function incomeBillRegistarGov(Request $request)
    {
        $date1 = strtotime( $request->income_start_date);
        $date2 = strtotime( $request->income_end_date);
        // $date2 = date('d/m/y', $date);

        $startDate = date('y/m/d', $date1);
        $endDate = date('y/m/d', $date2);
        
        $config = [
            'format' => 'A4-L' // Landscape
        ];
     

        $incomeCat = income::with('getIncomeCat')->get();
        $incomeSubCat = income::with('getSubIncomeCat')->get();
        $incomeBotSubCat = income::with('getBotSubIncomeCat')->get();
        $income = income::whereBetween('income_date', [$startDate, $endDate])->where('income_source','2')
        ->orderBy('income_date', 'ASC')->get();
        // $incomeSum = income::whereBetween('income_date', [$startDate, $endDate])->where('income_source','1')->sum('income_amount');

        //return $income;

        view()->share('income',$income,$incomeCat,$incomeSubCat, $incomeBotSubCat );
            
            $pdf = PDF::loadView('reportDownload.incomeBillRegistarDownloadGov',$income,[ ], $config);
            return $pdf->stream('document.pdf');
                    
        
        //return view('reportView.incomeAbView', compact('incomeCat', 'incomeSubCat', 'incomeBotSubCat', 'income'));
    }
    
     public function deleteUser()
    {   
          return view ('income.deleteUser');
    }


}
