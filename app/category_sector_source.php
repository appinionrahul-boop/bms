<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class category_sector_source extends Model
{
    protected $guarded = [];
   

    public function subSubCategory()
    {
        return $this->hasMany(incomeCategory::class);
    }

    public function incomeSubCategory()
    {
        return $this->hasMany(income::class);
    }


   
}
