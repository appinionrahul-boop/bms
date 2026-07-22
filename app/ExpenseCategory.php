<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExpenseCategory extends Model
{
    
    protected $guarded = [];

    public function category()
    {
        return $this->hasMany(ExpenseSubCategory::class);
    }

    public function expenseCategory()
    {
        return $this->hasMany(Expense::class);
    }
}
