<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sgc extends Model
{
    use Notifiable;
    use SoftDeletes;

    protected $table = 'sgc';
    protected $dates = ['deleted_at'];

    protected $fillable = [
        'code', 
        'area_id',
        'type', 
        'description',
        'create_date',
        'update_date',
        'user_id',
        
    ];

    public function sgcFile()
    {
        return $this->hasMany('App\SgcFile');
    }
}
