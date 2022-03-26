<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model
{
    //
    use SoftDeletes;
    

    public function users()
    {
        return $this->belongsToMany(User::class)->withTimestamps();
    }
}
