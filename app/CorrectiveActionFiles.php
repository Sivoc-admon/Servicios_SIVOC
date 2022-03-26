<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class CorrectiveActionFiles extends Model
{
    use Notifiable;
    use SoftDeletes;

    protected $fillable = [
        'corrective_action_id',
        'file', 
        'ruta'
        
    ];

    public function correctiveAction()
    {
        return $this->belongsTo('App\CorrectiveAction');
    }
}
