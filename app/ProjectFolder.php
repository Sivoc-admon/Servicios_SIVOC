<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProjectFolder extends Model
{
    use Notifiable;
    use SoftDeletes;

    protected $fillable = [
        'project_id',
        'name',
        'id_padre',
    ];

    public function projects()
    {
        return $this->belongsTo('App\Project');
    }

    public function childs()
    {
        return $this->hasMany('App\ProjectFolder', 'id_padre', 'id');
    }

    public function files()
    {
        return $this->hasMany('App\ProjectFile', 'id_padre');
    }

}
