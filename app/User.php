<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Fan;

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

    //用户的文章列表
    public function posts()
    {
        return $this->hasMany('App\Post');
    }

    //我的粉丝
    public function fans()
    {
        return $this->hasMany(\App\Fan::class,'star_id','id');
    }

    //我的关注
    public function stars()
    {
        return $this->hasMany(\App\Fan::class,'fan_id','id');
    }

    //关注某人
    public function doStar($uid)
    {
        $fan = new Fan();
        $fan->star_id=$uid;
        return $this->stars()->save($fan);
    }

    //取消关注
    public function doUnStar($uid)
    {
        $fan = new Fan();
        $fan->star_id=$uid;
        return $this->stars()->delete($fan);
    }

    //当前用户是否被uid关注了
    public function hasFan($uid)
    {
        return $this->fans()->where('fan_id',$uid)->count();
    }

    //当前用户是否关注uid了
    public function hasStar($uid)
    {
        return $this->stars()->where('star_id',$uid)->count();
    }
}
