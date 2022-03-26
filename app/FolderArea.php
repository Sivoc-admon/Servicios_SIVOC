<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FolderArea extends Model
{
    public function area(){
        return $this->belongsTo(Area::class);
    }

    public function areaDocuments(){
        return $this->hasMany(AreaDocument::class);
    }
}
