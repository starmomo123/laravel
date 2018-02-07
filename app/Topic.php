<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Topic extends BaseModel
{
    //得到某个专题的文章
    public function posts()
    {
        return $this->belongsToMany(\App\Post::class,'post_topics','topic_id','post_id');
    }

    //得到某个专题的文章数
    public function postTopics()
    {
        return $this->hasMany(\App\PostTopic::class,'topic_id','id');
    }
}
