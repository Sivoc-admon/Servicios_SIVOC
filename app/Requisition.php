<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Requisition extends Model
{
    use Notifiable;
    use SoftDeletes;

    protected $fillable = [
        'no_requisition',
        'id_area',
        'id_user',
        'status'
    ];

    public function requisitionFiles()
    {
        return $this->hasMany('App\RequisitionFile');
    }
}
