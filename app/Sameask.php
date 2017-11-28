<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sameask extends Model
{
    protected $table = 'sameasks';
    protected $fillable = [
        'user_id', 'question_id'
    ];
}
