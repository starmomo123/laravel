<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class AdminUser extends Authenticatable
{
    //
    protected  $guarded = [];
    protected $rememberTokenName = '';

    //判断用户拥有哪些角色
    public function roles()
    {
        return $this->belongsToMany(\App\AdminRole::class,'admin_user_roles','user_id','role_id')->withPivot(['user_id','role_id']);
    }

    //判断用户拥有某个角色
    public function isInRoles($roles)
    {
        return !!$roles->intersect($this->roles)->count();
    }

    //给用户分配角色
    public function assignRole($role)
    {
        return $this->roles()->save($role);
    }

    //取消用户角色
    public function deleteRole($role)
    {
        return $this->roles()->detach($role);
    }

    //判断用户是否有权限
    public function hasPermission($permission)
    {
        return $this->isInRoles($permission->roles);
    }

}
