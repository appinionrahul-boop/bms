<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExpenseSubCategory extends Model
{
    protected $guarded = [];

     
    public function expenseSubCat()
    {
      return $this->belongsTo(ExpenseCategory::class, 'expense_cateory_id');
    }
    public function expenseSubCategory()
    {
        return $this->hasMany(Expense::class);
    }
}
