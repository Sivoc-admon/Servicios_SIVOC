<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class SgcFile extends Model
{
    use Notifiable;
    use SoftDeletes;

    
    protected $dates = ['deleted_at'];

    protected $fillable = [
        'sgc_id', 
        'name', 
        'ruta',
        'revision'
        
    ];

    public function sgc()
    {
        return $this->belongsTo('App\Sgc');
    }
}
