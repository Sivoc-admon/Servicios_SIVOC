<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class AssetFile extends Model
{
    use Notifiable;
    use SoftDeletes;

    protected $fillable = [
        'asset_id', 
        'name', 
        'ruta',
        'type'

        
    ];

    public function asset()
    {
        return $this->belongsTo('App\Asset');
    }
}
