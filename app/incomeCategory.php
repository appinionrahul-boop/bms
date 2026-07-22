<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class incomeCategory extends Model
{
  protected $guarded = [];

    public function getIncomeCat()
    {
      return $this->belongsTo(category_sector::class, 'sector_source_id');
    }

    public function getSubIncomeCat()
    {
      return $this->belongsTo(category_sector_source::class, 'sub_sector_id');
    }

    public function incomeBotSubCategory()
    {
        return $this->hasMany(income::class);
    }
}
