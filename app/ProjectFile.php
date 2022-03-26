<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProjectFile extends Model
{
    use Notifiable;
    use SoftDeletes;

    protected $fillable = [
        'project_id',
        'name', 
        'ruta',
        
        
    ];

    public function projects()
    {
        return $this->belongsTo('App\Project');
    }
}
