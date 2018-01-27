<?php

namespace App;

use App;

class Post extends BaseModel
{
    //反向关联到User表
    public function user()
    {
        return $this->belongsTo('App\User','user_id','id');
    }

    //关联到评论表
    public function comments()
    {
        return $this->hasMany('App\Comment')->orderBy('created_at','desc');
    }
}