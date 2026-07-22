<?php

namespace App\Http\Controllers;

use App\Support\FiscalYear;
use Illuminate\Http\Request;

class FiscalYearSettingController extends Controller
{
    public function edit()
    {
        return view('settings.fiscal-year', [
            'activeFiscalYear' => FiscalYear::active(),
            'fiscalYears' => FiscalYear::all(),
            'previousFiscalYear' => FiscalYear::previous(),
            'nextFiscalYear' => FiscalYear::next(),
        ]);
    }

    public function update(Request $request)
    {
        $fiscalYears = FiscalYear::all()->all();

        $request->validate([
            'previous_fiscal_year' => 'required|in:' . implode(',', $fiscalYears),
            'active_fiscal_year' => 'required|in:' . implode(',', $fiscalYears),
            'next_fiscal_year' => 'required|in:' . implode(',', $fiscalYears),
        ]);

        FiscalYear::setAll(
            $request->previous_fiscal_year,
            $request->active_fiscal_year,
            $request->next_fiscal_year
        );

        return redirect()
            ->route('settings.fiscal-year.edit')
            ->with('msg', 'Fiscal year settings updated successfully.');
    }
}
