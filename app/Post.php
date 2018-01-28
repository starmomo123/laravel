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

    //一篇文章一个用户只能有一个赞
    public function zan($user_id)
    {
        return $this->hasOne(App\Zan::class)->where('user_id',$user_id);
    }

    //关联到一篇文章有多个赞
    public function zans()
    {
        return $this->hasMany(App\Zan::class);
    }
}