<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class ImagesResource extends Model
{
    use Notifiable;
    use SoftDeletes;

    protected $table = 'images_resource';

    protected $fillable = [
        'name',
        'path',
    ];
}
