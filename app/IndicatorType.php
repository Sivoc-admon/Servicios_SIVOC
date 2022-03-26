<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IndicatorType extends Model
{
    public $table = "indicator_type";
    public function indicator(){
        return $this->belongsTo(Indicator::class);
    }
}
