<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Area extends Model{

    use SoftDeletes;
    
    protected $dates = ['deleted_at'];

    public function areaFolder(){
        return $this->hasMany(FolderArea::class, 'id', 'area_id');
    }

    public function Users()
    {
        return $this->hasMany('App\User');
    }
}