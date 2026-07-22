<?php

namespace App\Http\Controllers;
use PDF;
// use Mpdf\Mpdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Support\FiscalYear;
use App\income;
use App\incomeCategory;
use App\category_sector_source;
use App\category_sector;
use App\Expense;
use App\ExpenseCategory;
use App\ExpenseSubCategory;
use App\User;

use App;

class ReportController extends Controller
{
        public function __construct()
    {
        set_time_limit(300);
    }
    public function monthWiseReport(Request $request)
   {
      $incomeCat = income::with('getIncomeCat')->get();
      $incomeSubCat = income::with('getSubIncomeCat')->get();
      $incomeBotSubCat = income::with('getBotSubIncomeCat')->get();
      $income = income::all();
  
       $users = User::all();
       view()->share('users',$users);

       if($request->has('download')) {
         
         $pdf = PDF::loadView('report.test', $users);
         return $pdf->stream('document.pdf');
                  
       }
       return view('report.incomeAbstract');
   }

   public function cashBookView()
   {
    return view('report.cashBook');
   }

  public function cashBookReportCp(Request $request)
   {    
    ini_set('memory_limit', '512M');
    ini_set('pcre.backtrack_limit', '10000000');
    $date1 = strtotime( $request->income_start_date);
    $date2 = strtotime( $request->income_end_date);

    $startDate = date('y/m/d', $date1);
    $endDate = date('y/m/d', $date2);

    $config = [
      'format' => 'A4-L',
    ];

    $income = DB::table((new income())->getTable())
      ->select([
        'income_date',
        'voucher_no',
        'income_cheque',
        'income_descriptation',
        'income_amount',
      ])
      ->whereBetween('income_date', [$startDate, $endDate])
      ->where('income_pred', '0')
      ->where(function ($query) {
        $query->where('income_source', '1')
          ->orWhere('income_source', '4')
          ->orWhere('income_sub_source', '20');
      })
      ->orderBy('income_date', 'ASC')
      ->get();

    $expense = DB::table((new Expense())->getTable())
      ->select([
        'expense_date',
        'voucher_no',
        'expense_cheque',
        'vat_cheque_descriptation',
        'tax_cheque_descriptation',
        'descriptation',
        'expense_folio',
        'tax_desriptation',
        'expense_amount',
        'vat_amount',
        'tax_amount',
        'totalExpense',
      ])
      ->whereBetween('expense_date', [$startDate, $endDate])
      ->where('expense_pred', '0')
      ->whereIn('expense_category', ['1', '4', '5'])
      ->orderBy('expense_date', 'ASC')
      ->get();

    $data = [
      'incomeCount' => $income->count(),
      'expenseCount' => $expense->count(),
      'startDate' => $startDate,
      'endDate' => $endDate,
      'sumIncome' => $income->sum('income_amount'),
      'sumExpense' => $expense->sum('totalExpense'),
      'rowChunks' => collect(range(0, max($income->count(), $expense->count()) - 1))
        ->map(function ($index) use ($income, $expense) {
          return [
            'income' => $income[$index] ?? null,
            'expense' => $expense[$index] ?? null,
          ];
        })
        ->chunk(150),
    ];

    $pdf = PDF::chunkLoadView('<html-separator/>', 'reportDownload.cashBookDownload', $data, [], $config);
    return $pdf->stream('document.pdf');
     
   }


   public function cashBookViewGov()
   {
    return view('report.cashBookGov');
   }

   
   public function cashBookReportGov(Request $request)
   {    
    // return view('report.cashBookGov');
    ini_set('pcre.backtrack_limit', '10000000');
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
    $income = income::whereBetween('income_date', [$startDate, $endDate])->where('income_source','2')->where('income_pred','0')
    -> Where('income_sub_source', '!=' ,'20')
    ->orderBy('income_date', 'ASC')->get();
    $incomeCount = income::whereBetween('income_date', [$startDate, $endDate])->where('income_source','2')
    -> Where('income_sub_source','!=','20')->count();
    // return $incomeCount;
    
    $expenseCat = Expense::with('getExpenseCategory')->get();
    $expenseSubCat = Expense::with('getExpenseSubCategory')->get();
    $expense = Expense::whereBetween('expense_date', [$startDate, $endDate])->where('expense_category','3')->where('expense_pred','0')->orderBy('expense_date', 'ASC')->get();
    // return $expense;
    $expenseCount =  Expense::whereBetween('expense_date', [$startDate, $endDate])->where('expense_category','3')->where('expense_pred','0')->count();
    
    view()->share('income',$income,$incomeCat,$incomeSubCat, $incomeBotSubCat );
    view()->share('expense',$expense,$expenseCat,$expenseSubCat );
    view()->share('expenseCount',$expenseCount );   
    view()->share('incomeCount',$incomeCount );   
    view()->share('startDate',$startDate );   
    view()->share('endDate',$endDate );      
            $pdf = PDF::loadView('reportDownload.cashBookDownloadGov',$income,[ ],$config);
            return $pdf->stream('document.pdf');
     
   }

   public function incomeBudgetView()
   {
    return view('report.incomeBudget');
   }

   public function incomeBudgetReport(Request $request)
   {
    $date1 = strtotime($request->income_start_date);
    $date2 = strtotime($request->income_end_date);

    $startDate = date('y/m/d', $date1);
    $endDate = date('y/m/d', $date2);

    $fy = FiscalYear::active();
    $fy1 = FiscalYear::next($fy);
    $fy2 = FiscalYear::previous($fy);

    $reportData = array_merge(
        $this->buildIncomeBudgetPayload('', $fy, '0', $startDate, $endDate),
        $this->buildIncomeBudgetPayload('p', $fy1, '1', $startDate, $endDate),
        $this->buildIncomeBudgetPayload('prv', $fy2, '0'),
        [
            'fy' => $fy,
            'fy1' => $fy1,
            'fy2' => $fy2,
        ]
    );

    view()->share($reportData);

      $pdf = PDF::loadView('reportDownload.incomeBudgetDownload');
      return $pdf->stream('document.pdf');


   }

   protected function buildIncomeBudgetPayload($suffix, $fiscalYear, $predictionFlag, $startDate = null, $endDate = null)
   {
        $summary = $this->getIncomeBudgetSummary($fiscalYear, $predictionFlag, $startDate, $endDate);

        return [
            'local1' . $suffix => $summary['bot_sources']->get('10', 0),
            'local2' . $suffix => $summary['bot_sources']->get('11', 0),
            'mT1' . $suffix => $summary['bot_sources']->get('12', 0),
            'mT2' . $suffix => $summary['bot_sources']->get('13', 0),
            'fee1' . $suffix => $summary['bot_sources']->get('14', 0),
            'fee2' . $suffix => $summary['bot_sources']->get('15', 0),
            'fee3' . $suffix => $summary['bot_sources']->get('16', 0),
            'sIncome1' . $suffix => $summary['bot_sources']->get('17', 0),
            'sIncome2' . $suffix => $summary['bot_sources']->get('18', 0),
            'sIncome3' . $suffix => $summary['bot_sources']->get('19', 0),
            'sIncome4' . $suffix => $summary['bot_sources']->get('20', 0),
            'sIncome5' . $suffix => $summary['bot_sources']->get('22', 0),
            'sIncome6' . $suffix => $summary['bot_sources']->get('23', 0),
            'sIncome7' . $suffix => $summary['bot_sources']->get('24', 0),
            'sIncome8' . $suffix => $summary['bot_sources']->get('25', 0),
            'sIncome9' . $suffix => $summary['bot_sources']->get('26', 0),
            'sIncome10' . $suffix => $summary['bot_sources']->get('27', 0),
            'sIncome11' . $suffix => $summary['bot_sources']->get('28', 0),
            'sIncome12' . $suffix => $summary['bot_sources']->get('29', 0),
            'sIncome13' . $suffix => $summary['bot_sources']->get('30', 0),
            'sIncome14' . $suffix => $summary['bot_sources']->get('31', 0),
            'sIncome15' . $suffix => $summary['bot_sources']->get('32', 0),
            'onudan' . $suffix => $summary['sub_sources']->get('7', 0),
            'orthoIn' . $suffix => $summary['sub_sources']->get('9', 0),
            'etc' . $suffix => $summary['sub_sources']->get('10', 0),
            'sumOwnIncome' . $suffix => $summary['sources']->get('1', 0),
            'gov1' . $suffix => $summary['sub_sources']->get('11', 0),
            'gov2' . $suffix => $summary['sub_sources']->get('12', 0),
            'gov3' . $suffix => $summary['sub_sources']->get('20', 0),
            'gov4' . $suffix => $summary['sub_sources']->get('13', 0),
            'sumGov' . $suffix => $summary['sources']->get('2', 0),
            'mul1' . $suffix => $summary['sub_sources']->get('8', 0),
            'mul2' . $suffix => $summary['sub_sources']->get('14', 0),
            'mul3' . $suffix => $summary['sub_sources']->get('15', 0),
            'mul4' . $suffix => $summary['sub_sources']->get('16', 0),
            'mul5' . $suffix => $summary['sub_sources']->get('17', 0),
            'mul6' . $suffix => $summary['sub_sources']->get('18', 0),
            'mul7' . $suffix => $summary['sub_sources']->get('19', 0),
        ];
   }

   protected function getIncomeBudgetSummary($fiscalYear, $predictionFlag, $startDate = null, $endDate = null)
   {
        $query = income::query()
            ->where('fiscal_year', $fiscalYear)
            ->where('income_pred', $predictionFlag);

        if (!empty($startDate) && !empty($endDate)) {
            $query->whereBetween('income_date', [$startDate, $endDate]);
        }

        $botSourceTotals = (clone $query)
            ->select('income_bot_source', DB::raw('SUM(income_amount) as total'))
            ->whereNotNull('income_bot_source')
            ->groupBy('income_bot_source')
            ->pluck('total', 'income_bot_source');

        $subSourceTotals = (clone $query)
            ->select('income_sub_source', DB::raw('SUM(income_amount) as total'))
            ->whereNotNull('income_sub_source')
            ->groupBy('income_sub_source')
            ->pluck('total', 'income_sub_source');

        $sourceTotals = (clone $query)
            ->select('income_source', DB::raw('SUM(income_amount) as total'))
            ->whereNotNull('income_source')
            ->groupBy('income_source')
            ->pluck('total', 'income_source');

        return [
            'bot_sources' => $botSourceTotals,
            'sub_sources' => $subSourceTotals,
            'sources' => $sourceTotals,
        ];
   }

   public function expenseBudgetView()
   {
    return view('report.expenseBudget');
   }

   public function expenseBudgetReport(Request $request)
   {
        $date1 = strtotime($request->income_start_date);
        $date2 = strtotime($request->income_end_date);

        $startDate = date('y/m/d', $date1);
        $endDate = date('y/m/d', $date2);

        $fy = FiscalYear::active();
        $fy1 = FiscalYear::next($fy);
        $fy2 = FiscalYear::previous($fy);

        $reportData = array_merge(
            $this->buildExpenseBudgetPayload('', $fy, '0', $startDate, $endDate),
            $this->buildExpenseBudgetPayload('p', $fy1, '1', $startDate, $endDate),
            $this->buildExpenseBudgetPayload('prv', $fy2, '0'),
            [
                'fy' => $fy,
                'fy1' => $fy1,
                'fy2' => $fy2,
            ]
        );

        view()->share($reportData);

        $pdf = PDF::loadView('reportDownload.expenseBudgetDownload');
        return $pdf->stream('document.pdf');

   }

   protected function buildExpenseBudgetPayload($suffix, $fiscalYear, $predictionFlag, $startDate = null, $endDate = null)
   {
        $summary = $this->getExpenseBudgetSummary($fiscalYear, $predictionFlag, $startDate, $endDate);
        $payload = [];

        for ($index = 0; $index <= 6; $index++) {
            $payload['ssB' . $index . $suffix] = $summary['sub_categories']->get((string) (8 + $index), 0);
        }

        for ($index = 1; $index <= 51; $index++) {
            $payload['sIncome' . $index . $suffix] = $summary['sub_categories']->get((string) (14 + $index), 0);
        }

        for ($index = 1; $index <= 3; $index++) {
            $payload['gov' . $index . $suffix] = $summary['sub_categories']->get((string) (65 + $index), 0);
        }

        for ($index = 1; $index <= 7; $index++) {
            $payload['mul' . $index . $suffix] = $summary['sub_categories']->get((string) (68 + $index), 0);
        }

        $payload['optionalActivities' . $suffix] = $this->resolveExpenseSubCategoryTotal(
            $summary['sub_categories'],
            ['ঐচ্ছিক কার্যাবলীর সংক্রান্ত ব্যয়', 'ঐচ্ছিক কার্যাবলী সংক্রান্ত ব্যয়']
        );

        $payload['developmentRevenue' . $suffix] = $this->resolveExpenseSubCategoryTotal(
            $summary['sub_categories'],
            ['উন্নায়ন ব্যয় (রাজস্ব)', 'উন্নয়ন ব্যয় (রাজস্ব)']
        );

        $payload['sIncomeSum' . $suffix] = $summary['categories']->get('4', 0);
        $payload['sumAll' . $suffix] = $summary['total'];

        return $payload;
   }

   protected function resolveExpenseSubCategoryTotal($subCategoryTotals, array $candidateNames)
   {
        // The DB may store Bangla characters in a different Unicode form than
        // this source file (e.g. precomposed য় U+09DF vs য + ় U+09AF U+09BC).
        // Whether MySQL treats those as equal depends on the column collation
        // (unicode_ci: yes, general_ci: no), so compare NFC-normalized values
        // in PHP instead of relying on the database.
        $candidates = array_map([$this, 'normalizeBanglaText'], $candidateNames);

        $match = ExpenseSubCategory::query()
            ->select('id', 'expense_subCategory')
            ->get()
            ->first(function ($subCategory) use ($candidates) {
                return in_array($this->normalizeBanglaText($subCategory->expense_subCategory), $candidates, true);
            });

        return $match ? $subCategoryTotals->get((string) $match->id, 0) : 0;
   }

   protected function normalizeBanglaText($value)
   {
        $value = trim(preg_replace('/\s+/u', ' ', (string) $value));

        if (class_exists('Normalizer')) {
            $normalized = \Normalizer::normalize($value, \Normalizer::FORM_C);
            if ($normalized !== false) {
                return $normalized;
            }
        }

        // Fallback without ext-intl: compose the Bangla nukta pairs by hand.
        return strtr($value, [
            "\u{09A1}\u{09BC}" => "\u{09DC}", // ড়
            "\u{09A2}\u{09BC}" => "\u{09DD}", // ঢ়
            "\u{09AF}\u{09BC}" => "\u{09DF}", // য়
        ]);
   }

   protected function getExpenseBudgetSummary($fiscalYear, $predictionFlag, $startDate = null, $endDate = null)
   {
        $query = Expense::query()
            ->where('fiscal_year', $fiscalYear)
            ->where('expense_pred', $predictionFlag);

        if (!empty($startDate) && !empty($endDate)) {
            $query->whereBetween('expense_date', [$startDate, $endDate]);
        }

        $subCategoryTotals = (clone $query)
            ->select('expense_sub_category', DB::raw('SUM(totalExpense) as total'))
            ->whereNotNull('expense_sub_category')
            ->groupBy('expense_sub_category')
            ->pluck('total', 'expense_sub_category');

        $categoryTotals = (clone $query)
            ->select('expense_category', DB::raw('SUM(totalExpense) as total'))
            ->whereNotNull('expense_category')
            ->groupBy('expense_category')
            ->pluck('total', 'expense_category');

        return [
            'sub_categories' => $subCategoryTotals,
            'categories' => $categoryTotals,
            'total' => (clone $query)->sum('totalExpense'),
        ];
   }
   
}
