<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdminPermission extends Model
{
    protected  $guarded = [];
    //当前权限分配到了哪些角色
    public function roles()
    {
        return $this->belongsToMany(\App\AdminRole::class,'admin_permission_roles','permission_id','role_id')->withPivot(['permission_id','role_id']);
    }

}
