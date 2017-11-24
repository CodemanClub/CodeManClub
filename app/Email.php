<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Email extends Model
{
    protected $table='eamil_verfication';
    protected $fillable = [
        'email', 'code',
    ];
}
