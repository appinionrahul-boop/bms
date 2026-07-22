<?php

namespace App\Support;

use App\Expense;
use App\Setting;
use App\income;
use Illuminate\Support\Facades\Schema;

class FiscalYear
{
    protected const DEFAULT_FISCAL_YEAR = '২০২৫-২০২৬';
    protected const ACTIVE_KEY = 'active_fiscal_year';
    protected const PREVIOUS_KEY = 'previous_fiscal_year';
    protected const NEXT_KEY = 'next_fiscal_year';

    public static function active()
    {
        $saved = self::getSetting(self::ACTIVE_KEY);

        if (!empty($saved)) {
            return $saved;
        }

        $latestIncomeYear = income::query()
            ->whereNotNull('fiscal_year')
            ->orderByDesc('income_date')
            ->value('fiscal_year');

        $latestExpenseYear = Expense::query()
            ->whereNotNull('fiscal_year')
            ->orderByDesc('expense_date')
            ->value('fiscal_year');

        return $latestIncomeYear ?: $latestExpenseYear ?: self::DEFAULT_FISCAL_YEAR;
    }

    public static function all()
    {
        $baseYears = [
            '২০২০-২০২১',
            '২০২১-২০২২',
            '২০২২-২০২৩',
            '২০২৩-২০২৪',
            '২০২৪-২০২৫',
            '২০২৫-২০২৬',
            '২০২৬-২০২৭',
        ];

        $dbYears = income::query()
            ->select('fiscal_year')
            ->whereNotNull('fiscal_year')
            ->pluck('fiscal_year')
            ->merge(
                Expense::query()
                    ->select('fiscal_year')
                    ->whereNotNull('fiscal_year')
                    ->pluck('fiscal_year')
            )
            ->filter()
            ->unique()
            ->values()
            ->all();

        $years = collect($baseYears)
            ->merge($dbYears)
            ->filter()
            ->unique()
            ->sortDesc()
            ->values();

        return $years;
    }

    /**
     * The years offered when creating or editing an income/expense entry:
     * previous, active, and next only.
     *
     * $include keeps an already-saved year in the list when editing an older
     * record, so reopening it cannot silently reassign its fiscal year.
     */
    public static function selectable($include = null)
    {
        return collect([
            self::previous(),
            self::active(),
            self::next(),
            $include,
        ])
            ->filter()
            ->unique()
            ->sortDesc()
            ->values();
    }

    public static function setActive($fiscalYear)
    {
        if (!Schema::hasTable('settings')) {
            return null;
        }

        return Setting::query()->updateOrCreate(
            ['key' => self::ACTIVE_KEY],
            ['value' => $fiscalYear]
        );
    }

    public static function next($fiscalYear = null)
    {
        $saved = self::getSetting(self::NEXT_KEY);

        if (!empty($saved) && $fiscalYear === null) {
            return $saved;
        }

        [$startYear] = self::parse($fiscalYear ?: self::active());

        return self::formatFromStartYear($startYear + 1);
    }

    public static function previous($fiscalYear = null)
    {
        $saved = self::getSetting(self::PREVIOUS_KEY);

        if (!empty($saved) && $fiscalYear === null) {
            return $saved;
        }

        [$startYear] = self::parse($fiscalYear ?: self::active());

        return self::formatFromStartYear($startYear - 1);
    }

    public static function setPrevious($fiscalYear)
    {
        return self::setSetting(self::PREVIOUS_KEY, $fiscalYear);
    }

    public static function setNext($fiscalYear)
    {
        return self::setSetting(self::NEXT_KEY, $fiscalYear);
    }

    public static function setAll($previousFiscalYear, $activeFiscalYear, $nextFiscalYear)
    {
        if (!Schema::hasTable('settings')) {
            return null;
        }

        foreach ([
            self::PREVIOUS_KEY => $previousFiscalYear,
            self::ACTIVE_KEY => $activeFiscalYear,
            self::NEXT_KEY => $nextFiscalYear,
        ] as $key => $value) {
            self::setSetting($key, $value);
        }

        return true;
    }

    protected static function parse($fiscalYear)
    {
        $normalized = self::toEnglishDigits($fiscalYear ?: self::DEFAULT_FISCAL_YEAR);
        $parts = explode('-', $normalized);
        $startYear = isset($parts[0]) ? (int) trim($parts[0]) : 2025;

        return [$startYear, $startYear + 1];
    }

    protected static function formatFromStartYear($startYear)
    {
        return self::toBanglaDigits($startYear . '-' . ($startYear + 1));
    }

    protected static function toEnglishDigits($value)
    {
        return strtr($value, [
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
    }

    protected static function toBanglaDigits($value)
    {
        return strtr($value, [
            '0' => '০',
            '1' => '১',
            '2' => '২',
            '3' => '৩',
            '4' => '৪',
            '5' => '৫',
            '6' => '৬',
            '7' => '৭',
            '8' => '৮',
            '9' => '৯',
        ]);
    }

    protected static function getSetting($key)
    {
        if (!Schema::hasTable('settings')) {
            return null;
        }

        return Setting::query()
            ->where('key', $key)
            ->value('value');
    }

    protected static function setSetting($key, $value)
    {
        if (!Schema::hasTable('settings')) {
            return null;
        }

        return Setting::query()->updateOrCreate(
            ['key' => $key],
            ['value' => $value]
        );
    }
}
