<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class RequisitionClassification extends Model
{
    use Notifiable;
    use SoftDeletes;

    protected $fillable = [
        'code',
        'description',
    ];


}
