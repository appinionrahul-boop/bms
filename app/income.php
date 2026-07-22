<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class income extends Model
{
  protected $guarded = [];

    public function getIncomeCat()
    {
      return $this->belongsTo(category_sector::class, 'income_source');
    }
    public function getSubIncomeCat()
    {
      return $this->belongsTo(category_sector_source::class, 'income_sub_source');
    }

    public function getBotSubIncomeCat()
    {
      return $this->belongsTo(incomeCategory::class, 'income_bot_source');
    }
}
