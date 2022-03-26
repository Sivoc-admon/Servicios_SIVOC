<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Agreement extends Model
{
    use Notifiable;
    use SoftDeletes;

    protected $table = 'agreement';

    protected $fillable = [
        'minute_id',
        'description', 
        
    ];

    public function Minutes()
    {
        return $this->belongsTo('App\Minute');
    }
}
