<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class RhFile extends Model
{
    use Notifiable;
    use SoftDeletes;

    
   

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 
        'name', 
        'ruta'
        
    ];

    public function users()
    {
        return $this->belongsTo('App\User');
    }
}
