<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use Notifiable;
    use SoftDeletes;

    protected $fillable = [
        'name',
        'name_project',
        'type',
        'client',
        'adicional',
        'status',
        'id_user',

    ];

    public function projectFiles()
    {
        return $this->hasMany('App\ProjectFile');
    }

    public function projectForders()
    {
        return $this->hasMany('App\ProjectFolder');
    }
}
