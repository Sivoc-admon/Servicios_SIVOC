<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Welcome extends Model
{
    use Notifiable;
    use SoftDeletes;

    protected $table = 'welcome';

    protected $fillable = [
        'name', 
        'color', 
        
    ];

    public function welcomeFile()
    {
       return $this->hasOne('App\WelcomeFile');
    }
}
