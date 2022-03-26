<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Indicator extends Model
{
    public function indicatorType(){
        return $this->hasMany(IndicatorType::class);
    }
}
