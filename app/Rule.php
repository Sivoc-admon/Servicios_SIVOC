<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Rule extends Model
{   
    use Notifiable;
    use SoftDeletes;

    protected $fillable = [
        'code',
        'name',
        'url'
    ];

    public function ruleFile(){
        return $this->hasMany('App\RuleFile');
    }
}
