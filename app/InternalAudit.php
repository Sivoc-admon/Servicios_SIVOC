<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class InternalAudit extends Model
{
    use Notifiable;
    use SoftDeletes;

    
    protected $dates = ['deleted_at'];

    protected $fillable = [
        'area_id', 
        'user_id', 
        'date_register',
        
    ];

    public function auditFiles(){
        return $this->hasMany('App\InternalAuditFile', 'internal_audits_id');
    }
}
