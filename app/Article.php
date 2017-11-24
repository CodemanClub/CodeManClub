<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $fillable = [
        'id','title', 'content', 'post_man_id','status_id','group_id'
    ];

    /**文章只属于一个作者
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(){
        return $this->belongsTo("App\User",'post_man_id','id');
    }
    public function comments(){
        return $this->hasMany('App\Comment');
    }

    public function group(){
        return $this->belongsTo('App\Group','group_id');
    }
}
