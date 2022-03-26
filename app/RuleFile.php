<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class RuleFile extends Model
{
    use Notifiable;
    use SoftDeletes;

    protected $fillable = [
        'rule_id',
        'name',
        'ruta'
    ];

    public function rule()
    {
        return $this->belongsTo('App\Rule');
    }
}
