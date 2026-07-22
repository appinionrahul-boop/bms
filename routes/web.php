<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::middleware(['auth'])->group(function(){

    
    Route::get('/', 'HomeController@index')->name('home');
    Route::get('/settings/fiscal-year', 'FiscalYearSettingController@edit')->name('settings.fiscal-year.edit');
    Route::post('/settings/fiscal-year', 'FiscalYearSettingController@update')->name('settings.fiscal-year.update');


    // Route::get('/income', 'IncomeController@incomeHome');
    // Route::resource('/income/create', 'IncomeController');

    // Route::get('/income-category', 'IncomeController@incomeCategory');
    // Route::resource('/income-category/create', 'IncomeCategoryController');

    // //IncomeSubCategory
    // Route::get('/income-category/createS', 'IncomeCategoryController@createSubSector');
    // Route::post('/income-category/createSub', 'IncomeCategoryController@storeSubSector');


    // Route::get('/income-category/getSubCat/{id}', 'IncomeCategoryController@GetSubCat');
    // Route::get('/income/getSubCatI/{id}', 'IncomeController@GetSubCat');
    // Route::get('/income/getBotSubCat/{id}', 'IncomeController@getBotSubCat');
    // Route::get('income/edit/{id}', 'IncomeController@editIncome')->name('income.edit');
    // Route::post('incomeEdit/{id}', 'IncomeController@updateIncome');
    // Route::get('income/delete/{id}', 'IncomeController@deleteIncome')->name('income.delete');
    // =======================
// INCOME ROUTES
// =======================

  // Income
Route::get('/income', 'IncomeController@incomeHome')->name('income.home');

// Show Create Form
Route::get('/income/create', 'IncomeController@index')->name('income.create');

// Store (POST)
Route::post('/income', 'IncomeController@store')->name('income.store');

Route::get('/income-category', 'IncomeController@incomeCategory')->name('income.category');
Route::get('/income-category/create', 'IncomeCategoryController@index')->name('income-category.create');
Route::post('/income-category/create', 'IncomeCategoryController@store')->name('income-category.store');
Route::get('/income-category/createS', 'IncomeCategoryController@createSubSector')->name('income-category.create-sector');
Route::post('/income-category/createSub', 'IncomeCategoryController@storeSubSector')->name('income-category.store-sector');
Route::get('/income-category/getSubCat/{id}', 'IncomeCategoryController@GetSubCat')->name('income-category.subcat');

// AJAX
Route::get('/income/sub-category/{id}', 'IncomeController@getSubCat')->name('income.subcat');
Route::get('/income/bot-sub-category/{id}', 'IncomeController@getBotSubCat')->name('income.botsubcat');

// Edit / Update / Delete (keep yours or clean like this)
Route::get('/income/edit/{id}', 'IncomeController@editIncome')->name('income.edit');
Route::post('/income/update/{id}', 'IncomeController@updateIncome')->name('income.update');
Route::get('/income/delete/{id}', 'IncomeController@deleteIncome')->name('income.delete');



    //Route::post('/category', 'IncomeCategoryController@store_register');

    //Expense
// =======================
// EXPENSE ROUTES
// =======================
    Route::resource('/expense', 'ExpenseController');
    // List page
    Route::get('/expense', 'ExpenseController@index')->name('expense.index');
    
    // Create form page
    Route::get('/expense/create', 'ExpenseController@addNewExpense')->name('expense.create');
    
    // Store (POST)
    Route::post('/expense', 'ExpenseController@store')->name('expense.store');
    Route::get('/expense_category', 'ExpenseCategoryController@index')->name('expense.category');
    Route::post('/expense_category', 'ExpenseCategoryController@store')->name('expense-category.store');
    
    // AJAX: Root -> Sub
    Route::get('/expense/sub-category/{id}', 'ExpenseController@getSubCat')->name('expense.subcat');
    
    // Edit / Update / Delete
    Route::get('/expense/edit/{id}', 'ExpenseController@editExpense')->name('expense.edit');
    Route::post('/expense/update/{id}', 'ExpenseController@updateExpense')->name('expense.update');
    Route::get('/expense/delete/{id}', 'ExpenseController@deleteExpense')->name('expense.delete');
    
    // Reports (keep your existing if needed)
    Route::get('expense/abR/{id}', 'ExpenseController@abstractReport')->name('expense.abR');
    Route::get('expense/bR/{id}', 'ExpenseController@billRegisterReport')->name('expense.bR');


    //Report /income-abstract-report
    Route::get('/report/monthWise', 'ReportController@monthWiseReport');

    //Income Report
    Route::post('/income-abstract-report', 'IncomeReportController@incomeAbstract');
   // Route::get('/income-abstract-report', 'IncomeReportController@incomeAbstract')->name('incomeAbstract-pdf');

   //Bill Registar Income
   Route::get('/report/income-bill-registar', 'IncomeReportController@viewBillRegistar');
   Route::post('/income-billRegistar-report', 'IncomeReportController@incomeBillRegistar');

   Route::get('/report/income-bill-registar-Gov', 'IncomeReportController@viewBillRegistarGov');
   Route::post('/income-billRegistar-reportGov', 'IncomeReportController@incomeBillRegistarGov');

   //Expense Report Astract
   Route::get('/report/expense/expenseAbs', 'ExpenseReportController@abstractDateSelect');
   Route::post('/expense-abstract-report', 'ExpenseReportController@expenseAbstract');
   Route::get('/report/expense/expenseAbsGov', 'ExpenseReportController@abstractDateSelectGov');
   Route::post('/expense-abstract-reportGov', 'ExpenseReportController@expenseAbstractGov');

   //Bill Registar Expense
   Route::get('/report/expense-bill-registar', 'ExpenseReportController@viewBillRegistar');
   Route::post('/expense-billRegistar-report', 'ExpenseReportController@expenseBillRegistar');

   Route::get('/report/expense-bill-registar-Gov', 'ExpenseReportController@viewBillRegistarGov');
   Route::post('/expense-billRegistar-reportGov', 'ExpenseReportController@expenseBillRegistarGov');

   //CashBookOwn
   Route::get('/report/cashBook', 'ReportController@cashBookView');
   Route::post('/cashBook-report', 'ReportController@cashBookReportCp');

   //CashBookGov
   Route::get('/report/cashBookGov', 'ReportController@cashBookViewGov');
   Route::post('/cashBook-reportGov', 'ReportController@cashBookReportGov');

   //Budget Income
   Route::get('/report/incomeBudget', 'ReportController@incomeBudgetView');
   Route::post('/income-budget-report', 'ReportController@incomeBudgetReport');

   //Budget Expense
   Route::get('/report/expenseBudget', 'ReportController@expenseBudgetView');
   Route::post('/expense-budget-report', 'ReportController@expenseBudgetReport');

   //Income Challan
   Route::get('/income-challan', 'ChallanController@incomeView');
   Route::get('challan/income/{id}', 'ChallanController@download')->name('challan.income');

   //Expense Challan
  Route::get('/expense-challan', 'ChallanController@expenseView')->name('expense-challan');
   Route::get('challan/expense/{id}', 'ChallanController@downloadEx')->name('challan.expense');
   // Temporary diagnostic for the expense budget report — remove after debugging.
   Route::get('/debug/expense-budget', function() {

      $collation = DB::selectOne("SELECT COLLATION_NAME FROM information_schema.COLUMNS WHERE TABLE_SCHEMA = DATABASE() AND TABLE_NAME = 'expense_sub_categories' AND COLUMN_NAME = 'expense_subCategory'");

      $subCats = DB::table('expense_sub_categories')
         ->where('expense_subCategory', 'like', '%রাজস্ব%')
         ->orWhere('expense_subCategory', 'like', '%ঐচ্ছিক%')
         ->get(['id', 'expense_subCategory'])
         ->map(function ($row) {
            return [
               'id' => $row->id,
               'name' => $row->expense_subCategory,
               'hex' => bin2hex($row->expense_subCategory),
            ];
         });

      $fy = App\Support\FiscalYear::active();
      $startDate = date('y/m/d', strtotime('2025-07-01'));
      $endDate = date('y/m/d', strtotime('2026-06-30'));

      $sub78 = DB::table('expenses')
         ->where('expense_sub_category', '78')
         ->selectRaw("COUNT(*) as cnt, SUM(totalExpense) as total, MIN(expense_date) as min_date, MAX(expense_date) as max_date")
         ->first();

      $sub78InReportQuery = DB::table('expenses')
         ->where('expense_sub_category', '78')
         ->where('fiscal_year', $fy)
         ->where('expense_pred', '0')
         ->whereBetween('expense_date', [$startDate, $endDate])
         ->selectRaw("COUNT(*) as cnt, SUM(totalExpense) as total")
         ->first();

      $controller = new App\Http\Controllers\ReportController();
      $hasNewCode = method_exists($controller, 'normalizeBanglaText');
      $resolved = null;
      if ($hasNewCode) {
         $method = new ReflectionMethod($controller, 'buildExpenseBudgetPayload');
         $method->setAccessible(true);
         $payload = $method->invoke($controller, '', $fy, '0', $startDate, $endDate);
         $resolved = [
            'developmentRevenue' => $payload['developmentRevenue'],
            'optionalActivities' => $payload['optionalActivities'],
         ];
      }

      $bladePath = resource_path('views/reportDownload/expenseBudgetDownload.blade.php');
      $bladeInfo = file_exists($bladePath)
         ? [
            'md5' => md5_file($bladePath),
            'modified' => date('Y-m-d H:i:s', filemtime($bladePath)),
            'mentions_developmentRevenue' => substr_count(file_get_contents($bladePath), 'developmentRevenue'),
         ]
         : 'FILE MISSING';

      return response()->json([
         'new_code_deployed' => $hasNewCode,
         'blade_view' => $bladeInfo,
         'php_version' => PHP_VERSION,
         'intl_normalizer' => class_exists('Normalizer'),
         'column_collation' => $collation->COLLATION_NAME ?? null,
         'active_fiscal_year' => $fy,
         'fiscal_years_in_expenses' => DB::table('expenses')->whereNotNull('fiscal_year')->distinct()->pluck('fiscal_year'),
         'matching_sub_categories' => $subCats,
         'expenses_sub78_all' => $sub78,
         'expenses_sub78_in_report_query' => $sub78InReportQuery,
         'resolved_report_values' => $resolved,
      ], 200, [], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);

   });

   Route::get('/clear', function() {

   Artisan::call('cache:clear');
   Artisan::call('config:clear');
   Artisan::call('config:cache');
   Artisan::call('view:clear');

   return "Cleared!";

});


});
