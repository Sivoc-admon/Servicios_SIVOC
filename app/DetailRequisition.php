<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class DetailRequisition extends Model
{
    use Notifiable;
    use SoftDeletes;

    protected $fillable = [
        'num_item',
        'id_clasification',
        'id_requisition',
        'quantity',
        'unit',
        'description',
        'model',
        'preference',
        'urgency',
        'status',
    ];
}
