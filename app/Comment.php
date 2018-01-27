<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends BaseModel
{
    //反向关联到文章表
    public function post()
    {
        return $this->belongsTo('App\Post');
    }
}
