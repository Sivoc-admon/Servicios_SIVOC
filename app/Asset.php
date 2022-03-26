<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Asset extends Model
{
    use Notifiable;
    use SoftDeletes;

    protected $fillable = [
        'description', 
        'clasification',
        'day_buy',
        'calibration',
        'date_calibration'
        
    ];

    public function assetFiles()
    {
        return $this->hasMany('App\AssetFile');
    }
}
