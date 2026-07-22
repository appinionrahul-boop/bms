<?php

namespace App\Http\Controllers;

use App\income;
use App\Expense;
use App\Support\FiscalYear;
use Carbon\Carbon;
use Illuminate\Http\Request;
use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $fy = $this->resolveFiscalYear();
        [$fyStart, $fyEnd] = $this->getFiscalYearRange($fy);

        $incomeBaseQuery = income::query()
            ->where('fiscal_year', $fy)
            ->where('income_pred', '0');

        $expenseBaseQuery = Expense::query()
            ->where('fiscal_year', $fy)
            ->where('expense_pred', '0');

        $totalIncome = (clone $incomeBaseQuery)->sum('income_amount');
        $totalExpense = (clone $expenseBaseQuery)->sum('totalExpense');

        $ownIncome = (clone $incomeBaseQuery)
            ->whereIn('income_source', ['1', '4'])
            ->sum('income_amount');

        $govIncome = (clone $incomeBaseQuery)
            ->where('income_source', '2')
            ->sum('income_amount');

        $ownExpense = (clone $expenseBaseQuery)
            ->whereIn('expense_category', ['1', '4', '5'])
            ->sum('totalExpense');

        $govExpense = (clone $expenseBaseQuery)
            ->where('expense_category', '3')
            ->sum('totalExpense');

        $surplus = $totalIncome - $totalExpense;
        $burnRate = $totalIncome > 0 ? round(($totalExpense / $totalIncome) * 100, 1) : 0;
        $govShare = $totalIncome > 0 ? round(($govIncome / $totalIncome) * 100, 1) : 0;
        $recordCount = (clone $incomeBaseQuery)->count() + (clone $expenseBaseQuery)->count();

        $monthlyTrends = collect();
        $cursor = $fyStart->copy();

        while ($cursor->lte($fyEnd)) {
            $monthStart = $cursor->copy()->startOfMonth()->format('Y-m-d');
            $monthEnd = $cursor->copy()->endOfMonth()->format('Y-m-d');

            $monthlyIncome = income::query()
                ->whereBetween('income_date', [$monthStart, $monthEnd])
                ->where('fiscal_year', $fy)
                ->where('income_pred', '0')
                ->sum('income_amount');

            $monthlyExpense = Expense::query()
                ->whereBetween('expense_date', [$monthStart, $monthEnd])
                ->where('fiscal_year', $fy)
                ->where('expense_pred', '0')
                ->sum('totalExpense');

            $monthlyTrends->push([
                'key' => strtolower($cursor->format('F')),
                'label' => $cursor->format('F'),
                'income' => $monthlyIncome,
                'expense' => $monthlyExpense,
                'balance' => $monthlyIncome - $monthlyExpense,
            ]);

            $cursor->addMonth();
        }

        $topIncomeSources = DB::table('incomes')
            ->leftJoin('category_sectors', 'category_sectors.id', '=', 'incomes.income_source')
            ->selectRaw("COALESCE(category_sectors.category_sector, 'অনির্ধারিত') as label, SUM(incomes.income_amount) as value")
            ->where('incomes.fiscal_year', $fy)
            ->where('incomes.income_pred', '0')
            ->groupBy('incomes.income_source', 'category_sectors.category_sector')
            ->orderByDesc('value')
            ->limit(5)
            ->get()
            ->map(function ($item, $index) {
                return [
                    'key' => 'income-source-' . $index,
                    'label' => $item->label,
                    'value' => (float) $item->value,
                ];
            })
            ->values();

        $topExpenseCategories = DB::table('expenses')
            ->leftJoin('expense_categories', 'expense_categories.id', '=', 'expenses.expense_category')
            ->selectRaw("COALESCE(expense_categories.expense_category, 'অনির্ধারিত') as label, SUM(expenses.totalExpense) as value")
            ->where('expenses.fiscal_year', $fy)
            ->where('expenses.expense_pred', '0')
            ->groupBy('expenses.expense_category', 'expense_categories.expense_category')
            ->orderByDesc('value')
            ->limit(5)
            ->get()
            ->map(function ($item, $index) {
                return [
                    'key' => 'expense-category-' . $index,
                    'label' => $item->label,
                    'value' => (float) $item->value,
                ];
            })
            ->values();

        $recentIncome = income::query()
            ->with('getIncomeCat')
            ->where('fiscal_year', $fy)
            ->where('income_pred', '0')
            ->orderByDesc('income_date')
            ->limit(4)
            ->get()
            ->map(function ($item) {
                return [
                    'key' => 'income-' . $item->id,
                    'type' => 'income',
                    'label' => optional($item->getIncomeCat)->category_sector ?: 'আয়',
                    'meta' => $item->voucher_no ?: 'ভাউচার নেই',
                    'date' => $item->income_date,
                    'amount' => (float) $item->income_amount,
                ];
            });

        $recentExpense = Expense::query()
            ->with('getExpenseCategory')
            ->where('fiscal_year', $fy)
            ->where('expense_pred', '0')
            ->orderByDesc('expense_date')
            ->limit(4)
            ->get()
            ->map(function ($item) {
                return [
                    'key' => 'expense-' . $item->id,
                    'type' => 'expense',
                    'label' => optional($item->getExpenseCategory)->expense_category ?: 'ব্যয়',
                    'meta' => $item->voucher_no ?: 'ভাউচার নেই',
                    'date' => $item->expense_date,
                    'amount' => (float) $item->totalExpense,
                ];
            });

        $recentActivity = $recentIncome
            ->concat($recentExpense)
            ->sortByDesc('date')
            ->take(6)
            ->values();

        $dashboardData = [
            'fiscalYear' => $fy,
            'cards' => [
                ['key' => 'total-income', 'label' => 'মোট আয়', 'value' => $totalIncome],
                ['key' => 'total-expense', 'label' => 'মোট ব্যয়', 'value' => $totalExpense],
                ['key' => 'surplus', 'label' => 'বর্তমান স্থিতি', 'value' => $surplus],
                ['key' => 'own-income', 'label' => 'রাজস্ব আয়', 'value' => $ownIncome],
                ['key' => 'own-expense', 'label' => 'রাজস্ব ব্যয়', 'value' => $ownExpense],
                ['key' => 'gov-income', 'label' => 'এডিপি আয়', 'value' => $govIncome],
                ['key' => 'gov-expense', 'label' => 'এডিপি ব্যয়', 'value' => $govExpense],
                ['key' => 'records', 'label' => 'মোট এন্ট্রি', 'value' => $recordCount],
            ],
            'totals' => [
                'totalIncome' => $totalIncome,
                'totalExpense' => $totalExpense,
                'ownIncome' => $ownIncome,
                'ownExpense' => $ownExpense,
                'govIncome' => $govIncome,
                'govExpense' => $govExpense,
                'surplus' => $surplus,
                'burnRate' => $burnRate,
                'govShare' => $govShare,
                'recordCount' => $recordCount,
            ],
            'monthlyExpenses' => $monthlyTrends,
            'topIncomeSources' => $topIncomeSources,
            'topExpenseCategories' => $topExpenseCategories,
            'recentActivity' => $recentActivity,
        ];

        return view('home', compact('dashboardData'));
    }

    protected function resolveFiscalYear()
    {
        return FiscalYear::active();
    }

    protected function getFiscalYearRange($fiscalYear)
    {
        $englishDigits = strtr((string) $fiscalYear, [
            '০' => '0',
            '১' => '1',
            '২' => '2',
            '৩' => '3',
            '৪' => '4',
            '৫' => '5',
            '৬' => '6',
            '৭' => '7',
            '৮' => '8',
            '৯' => '9',
        ]);

        [$startYear, $endYear] = array_pad(explode('-', $englishDigits), 2, null);
        $startYear = (int) ($startYear ?: now()->year);
        $endYear = (int) ($endYear ?: $startYear + 1);

        return [
            Carbon::create($startYear, 7, 1)->startOfDay(),
            Carbon::create($endYear, 6, 30)->endOfDay(),
        ];
    }
   
}
