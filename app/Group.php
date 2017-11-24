<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $fillable = [
        'name', 'create_man_id','intro'
    ];
    public function create_man(){
        return $this->belongsTo('App\User','create_man_id');
    }
    //一个小组内包含多篇文章
    public function articles(){
        return $this->hasMany('App\Article','group_id','id');
    }
    //小组和关注者之间是多对多的关系
    public function users(){
        return $this->belongsToMany('App\User','user_groups');
    }
    //一个小组内包含多个提问
    public function questions(){
        return $this->hasMany('App\Question');
    }

}
