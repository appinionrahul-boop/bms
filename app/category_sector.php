<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class category_sector extends Model
{
    protected $guarded = [];

    public function subCategory()
    {
        return $this->hasMany(incomeCategory::class);
    }

    public function incomeSubCategory()
    {
        return $this->hasMany(income::class);
    }
}
