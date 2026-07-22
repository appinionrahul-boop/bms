<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    protected $guarded = [];

    public function getExpenseCategory()
    {
      return $this->belongsTo(ExpenseCategory::class, 'expense_category');
    }
    public function getExpenseSubCategory()
    {
      return $this->belongsTo(ExpenseSubCategory::class, 'expense_sub_category');
    }

}
