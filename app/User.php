<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**一个用户可以写多篇文章
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function articles(){
        return $this->hasMany("App\Article",'post_man_id','id');
    }
    //用户和小组是多对多的关系
    public function groups(){
        return $this->belongsToMany('App\Group','user_groups');
    }
    //用户和问题之间是一对多的关系
    public function questions(){
        return $this->hasMany('App\Question','post_man_id');
    }
}
