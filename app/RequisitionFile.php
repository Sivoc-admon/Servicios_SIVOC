<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class RequisitionFile extends Model
{
    use Notifiable;
    use SoftDeletes;

    protected $fillable = [
        'requisition_id',
        'name',
        'ruta',
        'comment'
    ];

    public function requisition()
    {
        return $this->belongsTo('App\Requisition');
    }
}
