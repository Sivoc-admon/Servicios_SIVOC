<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Minute extends Model
{
    use Notifiable;
    use SoftDeletes;

    protected $fillable = [
        'description',
        'participant', 
        'external_participant',
        'status', 
        'type'
        
    ];

    public function agreements()
    {
        return $this->hasMany('App\Agreement');
    }

    public function agreementFiles()
    {
        return $this->hasMany('App\AgreementFile');
    }
}
