<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class AgreementFile extends Model
{
    use Notifiable;
    use SoftDeletes;

    protected $fillable = [
        'minute_id',
        'file', 
        'ruta'
        
    ];

    public function Minutes()
    {
        return $this->belongsTo('App\Minute');
    }
}
