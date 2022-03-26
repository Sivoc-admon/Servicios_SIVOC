<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class WelcomeFile extends Model
{
    use Notifiable;
    use SoftDeletes;

    protected $fillable = [
        'welcome_id', 
        'name',
        'ruta' 
        
    ];

    public function welcome()
    {
       return $this->belongsTo('App\Welcome');
    }
}
