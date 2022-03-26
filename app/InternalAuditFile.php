<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class InternalAuditFile extends Model
{
    use Notifiable;
    use SoftDeletes;

    protected $fillable = [
        'name', 
        'ruta', 
        'internal_audits_id',
        
    ];

    public function internalAudit()
    {
        return $this->belongsTo('App\InternalAudit')->orderBy('id','ASC');
    }
}
