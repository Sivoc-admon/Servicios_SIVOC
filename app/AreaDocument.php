<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AreaDocument extends Model
{
    //
    public function areaFolder()
    {
        return $this->belongsTo(FolderArea::class)->orderBy('id','ASC');
    }
}
