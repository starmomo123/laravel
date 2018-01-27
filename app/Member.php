<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    public static function getMember($id){
        return "我的ID：".$id;
    }
}
