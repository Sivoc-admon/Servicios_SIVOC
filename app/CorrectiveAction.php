<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class CorrectiveAction extends Model
{
    use Notifiable;
    use SoftDeletes;

    protected $fillable = [
        'issue', 
        'action', 
        'involved',
        'user_id',
        'status',
        
    ];

    public function correctiveActionFile()
    {
        return $this->hasMany('App\CorrectiveActionFiles');
    }
}
