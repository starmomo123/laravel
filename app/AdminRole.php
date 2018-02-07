<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdminRole extends Model
{
    protected  $guarded = [];
    //当前角色拥有哪些权限
    public function permissions()
    {
        return $this->belongsToMany(\App\AdminPermission::class,'admin_permission_roles','role_id','permission_id')->withPivot(['permission_id','role_id']);
    }

    //给角色赋予权限
    public function grantPermisison($permission)
    {
        return $this->permissions()->save($permission);
    }

    //取消角色的权限
    public function deletePermission($permission)
    {
        return $this->permissions()->detach($permission);
    }


    //判断某个角色是否拥有某个权限
    public function hasPermission($permission)
    {
        return $this->permissions->contains($permission);
    }
}
