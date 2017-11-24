<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = [
        'title', 'content', 'post_man_id','group_id'
    ];

    public function post_man(){
        return $this->belongsTo('App\User','post_man_id');
    }

    public function answers(){
        return $this->hasMany('App\Answer','question_id');
    }
}
