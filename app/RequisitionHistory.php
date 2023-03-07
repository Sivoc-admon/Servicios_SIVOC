<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class RequisitionHistory extends Model
{
    use Notifiable;
    use SoftDeletes;

    protected $fillable = [
        'requisition_id',
        'status',
        'user_id'
    ];

    public function requisition()
    {
        return $this->belongsTo('App\Requisition');
    }
}
